<?php

use app\daos\ProjectDao;
use app\services\Icons;
use app\services\MyString;

require_once('partials/_views.php');

$title = 'Projetos';

$assetsList = [
  // PROJECTS CSS
  '<link rel="stylesheet" href="' . $baseUrl . 'assets/css/projects.css">',
];

$searchForm = true;

$search = filter_input(
  INPUT_GET,
  'search',
  FILTER_SANITIZE_SPECIAL_CHARS
);

$projectDao = new ProjectDao();

if ($search) {
  // FILTER
  $projects = $projectDao->getByTitle($search);
} else {
  //ALL
  $projects = $projectDao->get();
}
?>

<?php
require_once('partials/_header.php');
?>

<main class="responsive-table">
  <h1>Projetos</h1>
  <hr>

  <?php if ($projects): ?>
    <table class="projects-table">
      <tr>
        <th>#</th>
        <th>#</th>
        <th>#</th>
        <th>#</th>
        <th>Título</th>
        <th>Descrição</th>
        <th>Tamanho</th>
      </tr>
      <?php foreach ($projects as $project): ?>
        <tr>
          <td title="Visualizar projeto">
            <a href="<?= $baseUrl ?>project.php?id=<?= $project->getId() ?>"
            class="primary-2">
              <?= Icons::eye() ?>
            </a>
          </td>
          <td title="Baixar projeto">
            <a href="#" class="success download-project-btn" id="<?= $project->getId() ?>"
            data-modal-target="downloadProjectModal">
              <?= Icons::download() ?>
            </a>
          </td>
          <td title="Editar projeto">
            <a href="<?= $baseUrl ?>update_project.php?id=<?= $project->getId() ?>"
            class="warning">
              <?= Icons::edit() ?>
            </a>
          </td>
          <td title="Remover projeto">
            <a href="<?= $baseUrl ?>delete_project_process.php?id=<?= $project->getId() ?>"
            class="danger">
              <?= Icons::trash() ?>
            </a>
          </td>
          <td><?= $project->getTitle() ?></td>
          <td>
            <?php
            $maxLen = 20;
            $description = $project->getDescription();
            if (strlen($description) > $maxLen) {
              echo MyString::slice($project->getDescription(), $maxLen) . '...';
            } else {
              echo $description;
            }
            ?>
          </td>
          <td><?= $project->getSize() ?>MB</td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endif; ?>
</main>

<?php
require_once('partials/_dowloadProjectModal.php');
?>

<?php
require_once('partials/_footer.php');
?>
