<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/menu.php'; ?>

<h2>🍪 Cookies y Sesiones en PHP</h2>

<p>
En PHP, las <strong>sesiones</strong> y <strong>cookies</strong> permiten almacenar información del usuario 
de forma persistente entre diferentes peticiones.  
Son herramientas fundamentales para la gestión de usuarios, autenticación, carritos de compra, preferencias, etc.
(<a href="https://www.php.net/manual/es/features.sessions.php" target="_blank">Manual de sesiones</a> · 
<a href="https://www.php.net/manual/es/reserved.variables.cookies.php" target="_blank">Manual de cookies</a>)
</p>

<ul>
    <li>🧠 <strong>Sesiones:</strong> guardan los datos en el <em>servidor</em>, identificando al usuario mediante un <code>ID de sesión</code>.</li>
    <li>🧭 <strong>Cookies:</strong> guardan datos en el <em>navegador del cliente</em> y se envían al servidor en cada petición HTTP.</li>
</ul>

<p>
A diferencia de las cookies, las sesiones son más seguras, ya que los datos no se almacenan directamente en el navegador del usuario.
</p>

<div class="divider"></div>

<h3>🔐 Gestión de sesión</h3>

<p>
En este ejercicio podrás iniciar y cerrar una sesión.  
Al iniciarla, se guarda el nombre del usuario en la variable superglobal <code>$_SESSION</code>.  
Esto permite mantener información entre páginas o recargas del sitio.
</p>

<form method="post" action="?page=cookiesSesiones" class="form-sesion">
    <label for="nombre_usuario">Nombre de usuario:</label>
    <input type="text" name="nombre_usuario" id="nombre_usuario" placeholder="Introduce tu nombre...">
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        <input type="submit" value="Iniciar sesión">
        <button type="submit" name="cerrar_sesion" value="1">Cerrar sesión</button>
    </div>
</form>

<h4>🧾 Sesión actual:</h4>
<p>
A continuación se muestra la información almacenada en la sesión actual mediante <code>$_SESSION</code>.  
Puedes observar cómo persiste mientras la sesión siga activa.
</p>

<pre class="console-demo"><?= print_r(SesionModel::obtenerInfo()['sesion'], true) ?></pre>

<p class="nota">
💡 <strong>Nota:</strong> Las sesiones deben iniciarse con <code>session_start()</code> antes de enviar cualquier salida al navegador.
</p>

<div class="divider"></div>

<h3>🍯 Gestión de cookies</h3>
<p>
Las <code>cookies</code> permiten guardar datos en el navegador del usuario.  
Este bloque permite crearlas, eliminarlas y visualizar las actuales.
</p>

<ul>
    <li>📦 <strong>Crear cookies:</strong> define un nombre y valor que se guardarán localmente en el navegador.</li>
    <li>🧹 <strong>Eliminar cookies:</strong> borra una cookie existente según su nombre.</li>
    <li>🔍 <strong>Ver cookies:</strong> lista todas las cookies accesibles desde <code>$_COOKIE</code>.</li>
</ul>

<div class="cookie-forms">
    <form method="post" action="?page=cookiesSesiones" class="form-cookie">
        <label for="nombre_cookie">Nombre de cookie:</label>
        <input type="text" name="nombre_cookie" id="nombre_cookie" placeholder="Ej. usuario">
        <label for="valor_cookie">Valor:</label>
        <input type="text" name="valor_cookie" id="valor_cookie" placeholder="Ej. David">
        <input type="submit" name="crear_cookie" value="Crear cookie">
    </form>

    <form method="post" action="?page=cookiesSesiones" class="form-cookie">
        <label for="nombre_cookie_eliminar">Nombre de cookie a eliminar:</label>
        <input type="text" name="nombre_cookie_eliminar" id="nombre_cookie_eliminar" placeholder="Ej. usuario">
        <input type="submit" name="eliminar_cookie" value="Eliminar cookie">
    </form>
</div>

<h4>🍪 Cookies actuales:</h4>
<p>
Se muestran todas las cookies disponibles actualmente en <code>$_COOKIE</code>.  
Recuerda que las cookies recién creadas aparecerán tras recargar la página.
</p>

<pre class="console-demo">
<?php
$cookies = SesionModel::obtenerInfo()['cookies'];
if (!empty($cookies)) {
    foreach ($cookies as $nombre => $valor) {
        echo htmlspecialchars($nombre) . " = " . htmlspecialchars($valor) . "\n";
    }
} else {
    echo "No hay cookies almacenadas actualmente.";
}
?>
</pre>

<p class="nota">
📘 Las cookies se crean con <code>setcookie(nombre, valor, expiración)</code> y pueden incluir parámetros de seguridad 
como <code>secure</code> o <code>httponly</code> para evitar ataques XSS.
</p>

<?php include __DIR__ . '/layout/footer.php'; ?>
