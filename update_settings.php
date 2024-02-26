<?php

use app\daos\SettingDao;

require_once('partials/_views.php');

$title = 'Cadastrar projeto';

$assetsList = [
  // SETTINGS CSS
  '<link rel="stylesheet" href="'.$baseUrl.'assets/css/settings.css">'
];
?>

<?php
require_once('partials/_header.php');
?>

<?php
$settingDao = new SettingDao();
$setting = $settingDao->get();
?>

<main>
  <h1>Configurações</h1>
  <hr>

  <form action="<?= $baseUrl ?>update_settings_process.php" method="POST"
  class="settings-form">
    <div class="form-group">
      <label for="projectDestination">Caminho padrão</label>
      <input type="text" name="projectDestination" id="projectDestination"
      placeholder="Informe o caminho padrão para seus projetos"
      value="<?= $setting->getProjectDestination() ?>">
      <hr>
    </div>
    <div class="form-group">
      <button class="form-btn">Salvar</button>
    </div>
  </form>
</main>

<?php
require_once('partials/_footer.php');
?>
