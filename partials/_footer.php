</section>

<footer>
  João Faust &copy;2024
</footer>

</div>

<!-- HANDLE REDIRECT -->
<script>
  (() => {
    // REDIRECT USING A BUTTON

    document.querySelectorAll('[data-redirect]').forEach((btn) => {
      btn.addEventListener('click', (e) => {
        const target = e.currentTarget;

        const page = target.dataset.redirect;

        window.location.href = page;
      });
    });
  })();
</script>

<!-- HANDLE MODAL -->
<script>
  // OPEN MODAL
  document.querySelectorAll('[data-modal-target]').forEach((el) => {
    el.addEventListener('click', (e) => {
      e.preventDefault();

      const target = e.currentTarget;

      const targetModalId = target.dataset.modalTarget;

      const myModal = document.getElementById(targetModalId);
      myModal.style.display = 'block';
    });
  });

  // CLOSE MODAL
  document.querySelectorAll('[data-modal-action="close"]').forEach((el) => {
    el.addEventListener('click', (e) => {
      const target = e.currentTarget;

      const targetModalId = target.dataset.modal;

      const myModal = document.getElementById(targetModalId);
      myModal.style.display = 'none';
    });
  });
</script>

</body>
</html>
