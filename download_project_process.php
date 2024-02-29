<?php

use app\daos\HistoryDao;
use app\daos\ProjectDao;
use app\daos\SettingDao;
use app\models\History;
use app\models\Project;
use app\services\OS;

require_once('partials/_initPage.php');

$projectId = filter_input(
  INPUT_POST,
  '_projectId',
  FILTER_SANITIZE_SPECIAL_CHARS
);

$projectTitle = filter_input(
  INPUT_POST,
  'projectTitle',
  FILTER_SANITIZE_SPECIAL_CHARS
);

Project::validateTitle($projectTitle); // VALIDATE TITLE

$projectDao = new ProjectDao();

if ($project = $projectDao->getById($projectId)) {
  $path = 'upload/' . $project->getZipName();

  $settingDao = new SettingDao();

  // GET SETTINGS
  $setting = $settingDao->get();

  // SET DESTINATION FOLDER
  $homePath = OS::getHomePath();
  $defaultDestFolder = $homePath . '/' . $setting->getProjectDestination();

  // EXTRACT ZIP
  $project->setTitle($projectTitle);
  $project->extractZip($defaultDestFolder, true);

  $historyDao = new HistoryDao();
  $history = new History();

  // SET HISTORY PROPERTIES
  $history->setProjectId($projectId);

  // ADD PROJECT IN HISTORY TABLE
  $historyDao->create($history);

  // REDIRECT
  header('Location:' . $baseUrl . 'projects.php');
}
