<?php
require_once('partials/_initPage.php');

$title = 'Cadastrar projeto';

$assetsList = [
  // CREATE PROJECTS CSS
  '<link rel="stylesheet" href="'.$baseUrl.'assets/css/create_project.css">'
];

require_once('partials/_header.php');
?>

<main class="create-project-main">
  <h1>Cadastrar projeto</h1>
  <hr>

  <form action="<?= $baseUrl ?>create_project_process.php" method="POST"
  class="project-form" enctype="multipart/form-data">
    <div class="form-group">
      <label for="title">Título</label>
      <input type="text" name="title" id="title" required maxlength="30"
      placeholder="Informe o título do projeto">
    </div>
    <div class="form-group">
      <label for="description">Descrição</label>
      <textarea name="description" id="description" required maxlength="250"
      placeholder="Informe a descrição do projeto"></textarea>
    </div>
    <div class="form-group">
      <label for="zip">Arquivo zip</label>
      <input type="file" name="zip" id="zip" required accept=".zip">
    </div>
    <div class="form-group">
      <button type="submit" class="form-btn">Cadastrar</button>
    </div>
  </form>
</main>

<?php
require_once('partials/_footer.php');
?>
