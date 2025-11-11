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

  if (sidebar.classList.contains('active')) {
    toggle.textContent = '✖';          // cambia a X
    toggle.style.left = '200px';        // a la derecha del menú
  } else {
    toggle.textContent = '☰';          // vuelve a hamburguesa
    toggle.style.left = '20px';
  }
});

overlay.addEventListener('click', () => {
  sidebar.classList.remove('active');
  main.classList.remove('shifted');
  overlay.classList.remove('show');
  toggle.textContent = '☰';
  toggle.style.left = '20px';
});

</script>


</body>
</html>
