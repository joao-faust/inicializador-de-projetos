<?php
use app\services\Icons;
?>

<div class="modal" id="downloadProjectModal">
  <div class="modal-container">
    <div class="modal-header">
      <h1>Baixar projeto</h1>
      <button class="btn-close" data-modal="downloadProjectModal"
      data-modal-action="close"
      aria-label="close" title="Fechar">
        <?= Icons::close() ?>
      </button>
    </div>
    <form action="<?= $baseUrl ?>download_project_process.php" method="POST">
      <div class="modal-body">
        <input type="hidden" name="_projectId" id="_projectId">
        <label for="projectTitle">Título do projeto</label>
        <input type="text" name="projectTitle" id="projectTitle" required
        autocomplete="off" placeholder="Informe o título do projeto">
      </div>
      <div class="modal-footer">
        <button class="form-btn" title="Fechar" data-modal="downloadProjectModal"
        data-modal-action="close">Sair</button>
        <button type="submit" class="form-btn">Baixar</button>
      </div>
    </form>
  </div>
</div>

<script>
  // SET THE CURRENT PROJECT ID IN THE #_projectId WITHIN THE #downloadProjectModal
  (() => {
    const downloadProjectBtn = document.querySelectorAll('[data-id="downloadProjectBtn"]');
    downloadProjectBtn.forEach((el) => {
      el.addEventListener('click', (e) => {
        const projectId = e.currentTarget.id;
        document.getElementById('_projectId').value = projectId;
      });
    });
  })();
</script>
