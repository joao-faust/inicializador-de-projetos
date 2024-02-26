<?php

namespace app\models;

use app\services\File;
use app\services\Message;
use app\services\OS;

class Project
{
  private int $id;
  private string $title;
  private string $description;
  private string $zipName;
  private float $size;

  // Setters and getters

  public function getId()
  {
    return $this->id;
  }

  public function setId(Int $id)
  {
    $this->id = $id;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function setTitle(string $title)
  {
    $this->title = $title;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function setDescription(string $description)
  {
    $this->description = $description;
  }

  public function getZipName()
  {
    return $this->zipName;
  }

  public function getSize()
  {
    return $this->size;
  }

  public function setSize(float $size)
  {
    $this->size = $size;
  }

  public function setZipName(string $zipName)
  {
    $this->zipName = $zipName;
  }

  public function uploadZip($file)
  {
    $generateName = File::genName('zip');
    $filename = 'upload/' . $generateName;
    File::upload($file['tmp_name'], $filename);
    $this->zipName = $generateName;
  }

  public function extractZip(string $destination, bool $code)
  {
    $zip = new \ZipArchive();

    $zipPath = 'upload/' . $this->zipName;
    $folderPath = $destination . '/' . $this->title;

    if ($zip->open($zipPath)) {
      $zip->extractTo($folderPath);
      $zip->close();

      if ($code) {
        OS::runCommand('CODE ' . '"' . $folderPath . '"');
      }
    } else {
      die('cannot open <$filename>\n' . $zip->getStatusString());
    }
  }

  public function convertSizeToMb()
  {
    $this->size = $this->size / 1024 / 1024;
  }

  // Validations

  public static function validateZip(String $type)
  {
    if (
      $type === '' or
      $type !== 'application/x-zip-compressed'
    ) {
      Message::set('Arquivo zip inválido', 'error', 'back');
    }
  }

  public static function validateTitle(String|bool $title)
  {
    if (
      !$title or
      empty($title) or
      strlen($title) > 30
    ) {
      Message::set('Título inválido', 'error', 'back');
    }
  }

  public static function validateDescription(String|bool $description)
  {
    if (
      !$description or
      empty($description) or
      strlen($description) > 250
    ) {
      Message::set('Descrição inválida', 'error', 'back');
    }
  }
}
