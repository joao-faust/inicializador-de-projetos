<?php

namespace app\daos;

use app\interfaces\ProjectDaoInterface;
use app\models\Project;

use app\services\Connection;

class ProjectDao implements ProjectDaoInterface
{
  private \PDO $conn;

  public function __construct()
  {
    $this->conn = Connection::getInstance();
  }

  public function get()
  {
    $q = "SELECT id, title, zip_name, description, size FROM project";

    $stmt = $this->conn->prepare($q);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $data = $stmt->fetchAll();

      $projects = [];

      foreach ($data as $row) {
        $project = new Project();

        $project->setId($row['id']);
        $project->setTitle($row['title']);
        $project->setDescription($row['description']);
        $project->setSize($row['size']);
        $project->setZipName($row['zip_name']);

        $projects[] = $project;
      }

      return $projects;
    }

    return false;
  }

  public function getById(int $id)
  {
    $q = "SELECT id, title, zip_name, description, size FROM project
    WHERE id = :1";

    $stmt = $this->conn->prepare($q);

    $stmt->bindValue(':1', $id);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $row = $stmt->fetch();

      $project = new Project();

      $project->setId($row['id']);
      $project->setTitle($row['title']);
      $project->setDescription($row['description']);
      $project->setSize($row['size']);
      $project->setZipName($row['zip_name']);

      return $project;
    }

    return false;
  }

  public function getByTitle(string $title)
  {
    $q = "SELECT id, title, zip_name, description, size FROM project
    WHERE title LIKE '%$title%'";

    $stmt = $this->conn->prepare($q);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $data = $stmt->fetchAll();

      $projects = [];

      foreach ($data as $row) {
        $project = new Project();

        $project->setId($row['id']);
        $project->setTitle($row['title']);
        $project->setDescription($row['description']);
        $project->setSize($row['size']);
        $project->setZipName($row['zip_name']);

        $projects[] = $project;
      }

      return $projects;
    }

    return false;
  }

  public function create(Project $project)
  {
    $q = "INSERT INTO project(title, zip_name, description, size)
    VALUES(:1, :2, :3, :4)";

    $stmt = $this->conn->prepare($q);

    $stmt->bindValue(':1', $project->getTitle());
    $stmt->bindValue(':2', $project->getZipName());
    $stmt->bindValue(':3', $project->getDescription());
    $stmt->bindValue(':4', $project->getSize());

    $stmt->execute();
  }

  public function update(Project $project)
  {
    $q = "UPDATE project SET title = :1, description = :2 WHERE id = :3";

    $stmt = $this->conn->prepare($q);

    $stmt->bindValue(':1', $project->getTitle());
    $stmt->bindValue(':2', $project->getDescription());
    $stmt->bindValue(':3', $project->getId());

    $stmt->execute();
  }

  public function updateZip(Project $project)
  {
    $q = "UPDATE project SET zip_name = :1 WHERE id = :2";

    $stmt = $this->conn->prepare($q);

    $stmt->bindValue(':1', $project->getZipName());
    $stmt->bindValue(':2', $project->getId());

    $stmt->execute();
  }

  public function delete(int $id)
  {
    $q = "DELETE FROM project WHERE id = :1";

    $stmt = $this->conn->prepare($q);

    $stmt->bindValue(':1', $id);

    $stmt->execute();
  }
}
