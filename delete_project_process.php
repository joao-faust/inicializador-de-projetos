<?php

use app\daos\ProjectDao;
use app\services\File;

require_once('partials/_process.php');

$projectId = filter_input(
  INPUT_GET,
  'id',
  FILTER_SANITIZE_SPECIAL_CHARS
);

$projectDao = new ProjectDao();

// GET THE PROJECT
if ($project = $projectDao->getById($projectId)) {
  $path = 'upload/' . $project->getZipName();

  // REMOVE FROM THE DISK
  if (File::destroy($path)) {
    // REMOVE FROM THE DATABASE
    $projectDao->delete($projectId);
    header('Location:' . $baseUrl . '/projects.php');
    exit;
  }
}

echo '<h1>NOT FOUND</h1>';
