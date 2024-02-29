<?php
use app\services\Message;
use app\services\Icons;

$message = Message::get();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- FONTAWESOME CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <!-- NORMALIZE CSS -->
  <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/normalize.css">
  <!-- VARS CSS -->
  <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/vars.css">
  <!-- COLORS CSS -->
  <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/colors.css">
  <!-- MESSAGES CSS -->
  <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/messages.css">
  <!-- MODAL.CSS -->
  <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/modal.css">
  <!-- FORMS CSS -->
  <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/forms.css">
  <!-- STYLES CSS -->
  <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/styles.css">
  <?php
  if (isset($assetsList)) {
    echo implode('', $assetsList);
  }
  ?>
  <title><?= $title ?></title>
</head>
<body>

  <div class="container">
    <header>
      <h1>
        <a href="<?= $baseUrl ?>" style="text-decoration: none; color: #fff;">
          Inicializador de projetos
        </a>
      </h1>
      <?php if (isset($searchForm) and $searchForm): ?>
        <form method="GET" id="searchForm" class="search-form">
          <label for="search" hidden></label>
          <input type="search" name="search" id="search" placeholder="Pesquisar">
          <button id="makeSearch" title="Pesquisar">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </form>
        <script>
          (() => {
            const searchForm = document.getElementById('searchForm');

            // SUBMIT THE SEARCH FORM
            searchForm.addEventListener('submit', (e) => {
              e.preventDefault();

              const search = document.getElementById('search');
              if (search.value) {
                // SUBMIT WHEN THE SEARCH PARAMAETER IS AVAILABLE
                e.target.submit();
              } else {
                // RELOAD THE PAGE WHEN THERE'S NO SEARCH PARAMETER AVAILABLE
                const location = window.location;

                window.location.href = location.origin + location.pathname;
              }
            });
          })();
        </script>
      <?php endif; ?>
    </header>

    <aside>
      <ul>
        <li>
          <a href="<?= $baseUrl ?>create_project.php" class="success"
          title="Cadastrar projeto">
            <?= Icons::plus() ?>
          </a>
        </li>
        <li>
          <a href="<?= $baseUrl ?>" class="primary-1" title="Lista de projetos">
            <?= Icons::folder() ?>
          </a>
        </li>
        <li>
          <a href="<?= $baseUrl ?>recent_projects.php" class="primary-2"
          title="Projetos recentes">
            <?= Icons::openFolder() ?>
          </a>
        </li>
        <li id="settings">
          <a href="<?= $baseUrl ?>update_settings.php" class="secondary"
          title="Configurações">
            <?= Icons::settings() ?>
          </a>
        </li>
      </ul>
    </aside>

    <section class="content-container responsive-table">
      <?php if ($message): ?>
        <div class="message <?= $message['type'] ?>">
          <?= $message['message'] ?>
        </div>
      <?php endif; ?>
