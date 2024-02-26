<?php

use app\daos\ProjectDao;
use app\services\Icons;
use app\services\MyString;

require_once('partials/_views.php');

$title = 'Editar projeto';

$assetsList = [
  // CREATE PROJECTS CSS
  '<link rel="stylesheet" href="'.$baseUrl.'assets/css/create_project.css">'
];
?>

<?php
require_once('partials/_header.php');
?>

<main class="create-project-main">
  <h1>Editar projeto</h1>
  <hr>

  <?php
  $projectId = filter_input(
    INPUT_GET,
    'id',
    FILTER_SANITIZE_SPECIAL_CHARS
  );

  $projectDao = new ProjectDao();

  $project = $projectDao->getById($projectId);

  if (!$project) {
    echo '<h1>NOT FOUND</h1>';
    exit;
  }
  ?>

  <form action="<?= $baseUrl ?>update_project_process.php?id=<?= $projectId ?>"
  method="POST"
  class="project-form" enctype="multipart/form-data">
    <div class="form-group">
      <label for="title">Título</label>
      <input type="text" name="title" id="title" required maxlength="30"
      placeholder="Informe o título do projeto" value="<?= $project->getTitle() ?>">
    </div>
    <div class="form-group">
      <label for="description">Descrição</label>
      <textarea name="description" id="description" required maxlength="250"
      placeholder="Informe a descrição do projeto"><?= MyString::showOnTextArea($project->getDescription()) ?></textarea>
    </div>
    <div class="form-group">
      <label for="zip">Arquivo zip</label>
      <input type="file" name="zip" id="zip" accept=".zip">
    </div>
    <div class="form-group">
      <button class="form-btn back-btn" title="Voltar" role="link" tabindex="0"
      data-redirect="<?= $baseUrl ?>projects.php">
        <?= Icons::back() ?>
      </button>
      <button type="submit" class="form-btn">Editar</button>
    </div>
  </form>
</main>

<?php
require_once('partials/_footer.php');
?>
