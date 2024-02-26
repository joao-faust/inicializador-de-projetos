<?php

use app\daos\HistoryDao;
use app\services\Icons;
use app\services\MyString;

require_once('partials/_views.php');

$title = 'Cadastrar projeto';

$assetsList = [
  // CREATE PROJECTS CSS
  '<link rel="stylesheet" href="' . $baseUrl . 'assets/css/projects.css">'
];
?>
<?php
require_once('partials/_header.php');
?>

<?php
$historyDao = new HistoryDao();

$recentProjects = $historyDao->get();
?>

<main class="create-project-main responsive-table">
  <h1>Projetos recentes</h1>
  <hr>

  <p>
    <strong>Mostra os cinco últimos projetos baixados</strong>
  </p>

  <?php if ($recentProjects): ?>
    <table class="projects-table">
      <tr>
        <th>#</th>
        <th>#</th>
        <th>Título</th>
        <th>Descrição</th>
        <th>Tamanho</th>
      </tr>
      <?php foreach ($recentProjects as $project): ?>
        <tr>
          <td title="Visualizar projeto">
            <a href="<?= $baseUrl ?>project.php?id=<?= $project->getId() ?>"
            class="primary-2">
              <?= Icons::eye() ?>
            </a>
          </td>
          <td title="Baixar projeto">
            <a href="<?= $baseUrl ?>download_project_process.php?id=<?= $project->getId() ?>"
            class="success download-project-btn" id="<?= $project->getId() ?>"
            data-modal-target="downloadProjectModal">
              <?= Icons::download() ?>
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
