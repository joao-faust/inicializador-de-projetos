<?php

namespace app\daos;

use app\interfaces\HistoryDaoInterface;
use app\services\Connection;
use app\models\History;
use app\models\Project;

class HistoryDao implements HistoryDaoInterface
{
  private \PDO $conn;

  public function __construct()
  {
    $this->conn = Connection::getInstance();
  }

  public function create(History $history)
  {
    $q = "INSERT INTO history(project_id) VALUES (:1)";

    $stmt = $this->conn->prepare($q);

    $stmt->bindValue(':1', $history->getProjectId());

    $stmt->execute();
  }

  public function get()
  {
    $q = "SELECT p.id, p.title, p.zip_name, p.description, p.size
    FROM project p INNER JOIN (SELECT DISTINCT project_id FROM history) h ON
    p.id = h.project_id ORDER BY h.project_id DESC LIMIT 5";

    $stmt = $this->conn->prepare($q);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $data = $stmt->fetchAll();

      $projects = [];

      foreach ($data as $row) {
        $project = new Project();

        $project->setId($row['id']);
        $project->setTitle($row['title']);
        $project->setZipName($row['zip_name']);
        $project->setDescription($row['description']);
        $project->setSize($row['size']);

        $projects[] = $project;
      }

      return $projects;
    }

    return false;
  }
}
