<?php

use app\daos\SettingDao;
use app\models\Setting;

require_once('partials/_process.php');

$projectDestination = filter_input(
  INPUT_POST,
  'projectDestination',
  FILTER_SANITIZE_SPECIAL_CHARS
);

$settingDao = new SettingDao();
$setting = new Setting();

// SET SETTING PROPERTIES
$setting->setProjectDestination($projectDestination);

// UPDATE SETTINGS
$settingDao->update($setting);

// REDIRECT
header('Location:' . $baseUrl . 'update_settings.php');
