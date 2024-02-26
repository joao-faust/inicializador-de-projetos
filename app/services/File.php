<?php

namespace app\services;

class File
{
  public static function genName(string $ext)
  {
    return md5(uniqid()) . '.' . $ext;
  }

  public static function upload(string $from, string $to)
  {
    move_uploaded_file($from, $to);
    return $to;
  }

  public static function destroy(string $path)
  {
    return unlink($path);
  }
}
