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

// Elemento del botón
const toggleButton = document.getElementById("toggle-theme");

// Función para activar/desactivar modo oscuro
function setTheme(dark) {
  if(dark) {
    document.documentElement.classList.add("dark-mode");
    toggleButton.textContent = "☀️ Modo Claro";
  } else {
    document.documentElement.classList.remove("dark-mode");
    toggleButton.textContent = "🌙 Modo Oscuro";
  }
  // Guardar en localStorage
  localStorage.setItem("darkMode", dark);
}

// Revisar si el usuario ya tiene una preferencia guardada
const savedMode = localStorage.getItem("darkMode");
if(savedMode !== null) {
  setTheme(savedMode === "true");
} else {
  // Si no hay preferencia guardada, detectar modo del sistema
  const prefersDark = window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches;
  setTheme(prefersDark);
}

// Cambiar modo al hacer click
toggleButton.addEventListener("click", () => {
  const isDark = document.documentElement.classList.contains("dark-mode");
  setTheme(!isDark);
});

</script>


</body>
</html>
