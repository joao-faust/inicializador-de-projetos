<?php

use app\daos\ProjectDao;
use app\models\Project;
use app\services\File;

require_once('partials/_initPage.php');

$projectId = filter_input(
  INPUT_GET,
  'id',
  FILTER_SANITIZE_SPECIAL_CHARS
);

$title = filter_input(
  INPUT_POST,
  'title',
  FILTER_SANITIZE_SPECIAL_CHARS
);

$description = filter_input(
  INPUT_POST,
  'description',
  FILTER_SANITIZE_SPECIAL_CHARS
);

$projectDao = new ProjectDao();

if ($project = $projectDao->getById($projectId)) {
  // VALIDATIONS
  Project::validateTitle($title);
  Project::validateDescription($description);

  $newProject = new Project();

  // SET PROJECT PROPERTIES
  $newProject->setId($projectId);
  $newProject->setTitle($title);
  $newProject->setDescription($description);

  // UPDATE
  $projectDao->update($newProject);

  if ($_FILES['zip']['name'] !== '') {
    // UPDATE ZIP

    // REMOVE OLD ZIP FROM THE DISK
    $path = 'upload/' . $project->getZipName();
    File::destroy($path);

    $newProject = new Project();

    // SET PROJECT PROPERTIES
    $newProject->setId($projectId);
    $newProject->uploadZip($_FILES['zip']);

    // UPDATE
    $projectDao->updateZip($newProject);
  }

  // REDIRECT
  header('Location:' . $baseUrl . 'projects.php');
  exit;
}

echo '<h1>NOT FOUND</h1>';
