<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/menu.php'; ?>

<h2>Cookies y Sesiones en PHP</h2>

<p>En PHP, las <strong>sesiones</strong> y <strong>cookies</strong> permiten almacenar información del usuario:
<ul>
    <li><strong>Sesiones:</strong> Guardan datos en el servidor, identificando al usuario mediante un ID de sesión.</li>
    <li><strong>Cookies:</strong> Guardan datos en el navegador del usuario, y se envían al servidor en cada petición.</li>
</ul>
Estas herramientas son útiles para recordar usuarios, preferencias, carritos de compra, o cualquier dato temporal.</p>

<hr>

<h3>Gestión de sesión</h3>
<p>Este ejercicio permite iniciar y cerrar sesiones. Al iniciar sesión, se guarda el nombre del usuario en <code>$_SESSION</code>.</p>

<form method="post" action="?page=cookiesSesiones">
    <label for="nombre_usuario">Nombre de usuario:</label>
    <input type="text" name="nombre_usuario" id="nombre_usuario">
    <input type="submit" value="Iniciar sesión">
    <button type="submit" name="cerrar_sesion" value="1">Cerrar sesión</button>
</form>

<h4>Sesión actual:</h4>
<p>La información guardada en la sesión se muestra aquí. Esto ayuda a ver qué datos se mantienen mientras dure la sesión.</p>
<pre><?= print_r(SesionModel::obtenerInfo()['sesion'], true) ?></pre>

<hr>

<h3>Gestión de cookies</h3>
<p>Las cookies permiten almacenar datos en el navegador del usuario. Este ejercicio permite:</p>
<ul>
    <li>Crear cookies con un nombre y valor.</li>
    <li>Eliminar cookies existentes.</li>
    <li>Visualizar todas las cookies actuales.</li>
</ul>

<form method="post" action="?page=cookiesSesiones">
    <label for="nombre_cookie">Nombre de cookie:</label>
    <input type="text" name="nombre_cookie" id="nombre_cookie">
    <label for="valor_cookie">Valor:</label>
    <input type="text" name="valor_cookie" id="valor_cookie">
    <input type="submit" name="crear_cookie" value="Crear cookie">
</form>

<form method="post" action="?page=cookiesSesiones" style="margin-top: 10px;">
    <label for="nombre_cookie_eliminar">Nombre de cookie a eliminar:</label>
    <input type="text" name="nombre_cookie_eliminar" id="nombre_cookie_eliminar">
    <input type="submit" name="eliminar_cookie" value="Eliminar cookie">
</form>

<h4>Cookies actuales:</h4>
<p>Se muestran todas las cookies disponibles en <code>$_COOKIE</code>. Recuerda que las cookies recién creadas aparecerán en la siguiente carga de página.</p>
<ul>
<?php foreach (SesionModel::obtenerInfo()['cookies'] as $c => $v): ?>
    <li><strong><?= htmlspecialchars($c) ?>:</strong> <?= htmlspecialchars($v) ?></li>
<?php endforeach; ?>
</ul>

<?php include __DIR__ . '/layout/footer.php'; ?>
