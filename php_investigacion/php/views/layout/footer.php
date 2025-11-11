</main>
<footer>
    <p>© 2025 · Grupo Miguel, Jacobo y David</p>
</footer>
<script>
  const toggle = document.getElementById('menu-toggle');
  const sidebar = document.querySelector('aside');
  const main = document.querySelector('main');
  const overlay = document.getElementById('overlay');

  toggle.addEventListener('click', () => {
    sidebar.classList.toggle('active');
    main.classList.toggle('shifted');
    overlay.classList.toggle('show');
  });

  // Cerrar al hacer clic en el overlay
  overlay.addEventListener('click', () => {
    sidebar.classList.remove('active');
    main.classList.remove('shifted');
    overlay.classList.remove('show');
  });
</script>


</body>
</html>
