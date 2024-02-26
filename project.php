<?php

use app\daos\ProjectDao;
use app\services\Icons;
use app\services\MyString;

require_once('partials/_views.php');

$title = 'Projeto';

$assetsList = [
  // CREATE PROJECTS CSS
  '<link rel="stylesheet" href="'.$baseUrl.'assets/css/project.css">'
];
?>

<?php
require_once('partials/_header.php');
?>

<main>
  <?php
  $projectId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $projectDao = new ProjectDao();
  ?>

  <div class="project-container">
    <?php if ($project = $projectDao->getById($projectId)): ?>
      <h1><?= $project->getTitle() ?></h1>
      <p>
        <strong>Código:</strong>
        <?= $project->getId() ?>
      </p>
      <p>
        <strong>Descrição:</strong>
        <br>
        <?= MyString::addLineBreak(MyString::show($project->getDescription()), 80) ?>
      </p>
      <p>
        <strong>Tamanho:</strong>
        <?= $project->getSize() ?>MB
      </p>
      <p>
        <button class="form-btn back-btn" title="Voltar" role="link" tabindex="0"
        data-redirect="<?= $_SERVER['HTTP_REFERER'] ?>">
          <?= Icons::back() ?>
        </button>
        <button class="form-btn" title="Baixar projeto">
          <?= Icons::download() ?>
        </button>
      </p>
    <?php endif; ?>
  </div>
</main>

<?php
require_once('partials/_footer.php');
?>
