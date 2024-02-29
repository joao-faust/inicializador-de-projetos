<?php

use app\daos\ProjectDao;
use app\models\Project;

require_once('partials/_initPage.php');

$title = filter_input(
  INPUT_POST,
  'title',
  FILTER_SANITIZE_FULL_SPECIAL_CHARS
);

$description = filter_input(
  INPUT_POST,
  'description',
  FILTER_SANITIZE_FULL_SPECIAL_CHARS
);

// VALIDATIONS
Project::validateTitle($title);
Project::validateDescription($description);
Project::validateZip($_FILES['zip']['type']);

$projectDao = new ProjectDao();
$project = new Project();

// SET PROJECT PROPERTIES
$project->setTitle($title);
$project->setDescription($description);
$project->setSize($_FILES['zip']['size']);
$project->convertSizeToMb();
// UPLOAD ZIP
$project->uploadZip($_FILES['zip']);

// ADD PROJECT IN DATABASE
$projectDao->create($project);

// REDIRECT
header('Location:' . $baseUrl);
