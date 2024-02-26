<?php

namespace app\daos;

use app\interfaces\SettingDaoInterface;
use app\models\Setting;
use app\services\Connection;

class SettingDao implements SettingDaoInterface
{
  private \PDO $conn;

  public function __construct()
  {
    $this->conn = Connection::getInstance();
  }

  public function get()
  {
    $q = "SELECT * FROM setting";

    $stmt = $this->conn->prepare($q);

    $stmt->execute();

    $data = $stmt->fetch();

    $setting = new Setting();
    $setting->setProjectDestination($data['project_destination']);

    return $setting;
  }

  public function update(Setting $setting)
  {
    $q = "UPDATE setting SET project_destination = :1 WHERE id = 1";

    $stmt = $this->conn->prepare($q);

    $stmt->bindValue(':1', $setting->getProjectDestination());

    $stmt->execute();
  }
}
