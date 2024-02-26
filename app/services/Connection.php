<?php

namespace app\services;

class Connection
{
  private static $instance;

  public static function getInstance(): \PDO
  {
    if (is_null(self::$instance)) {
      $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
      $dotenv->load();

      $host = $_ENV['DB_HOST'];
      $dbname = $_ENV['DB_NAME'];
      $user = $_ENV['DB_USER'];
      $pass = $_ENV['DB_PASS'];

      try {
        self::$instance = new \PDO("mysql:$host=;dbname=$dbname", $user, $pass);
      } catch (\PDOException $e) {
        die($e->getMessage());
      }
    }

    return self::$instance;
  }
}
