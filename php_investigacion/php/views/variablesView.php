<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/menu.php'; ?>

<h2>Variables PHP — $_SERVER, $_GET, $_POST, $_REQUEST y $_ENV</h2>

<p>En PHP existen varias <strong>variables superglobales</strong> que permiten intercambiar información entre el cliente y el servidor.
Estas variables están disponibles en cualquier punto del código, sin necesidad de ser declaradas, 
y cada una cumple un papel diferente según el tipo de dato que maneja.</p>

<hr>

<h3>$_SERVER</h3>
<p><code>$_SERVER</code> contiene información sobre el entorno del servidor: dirección IP, 
software que ejecuta el servidor o el método de solicitud HTTP utilizado. 
Es útil para conocer datos técnicos de la ejecución del script.</p>

<ul>
    <li><strong>IP del servidor:</strong> <?= htmlspecialchars($datos['ip']); ?></li>
    <li><strong>Software:</strong> <?= htmlspecialchars($datos['software']); ?></li>
</ul>

<hr>

<h3>$_GET</h3>
<p><code>$_GET</code> se utiliza para recibir información enviada mediante la URL. 
Los parámetros que se envían son visibles en la barra de direcciones, 
por lo que este método se usa normalmente para búsquedas o consultas rápidas.</p>

<form method="get" action="?page=variables">
    <label>Tu nombre:</label>
    <input type="text" name="nombre">
    <input type="submit" value="Enviar">
</form>

<?php if (isset($_GET['nombre'])): ?>
    <p>¡Hola <?= htmlspecialchars($_GET['nombre']); ?>!</p>
<?php endif; ?>

<hr>

<h3>$_POST</h3>
<p><code>$_POST</code> permite enviar información al servidor sin que aparezca en la URL. 
Es el método más habitual para procesar formularios con datos personales, contraseñas o información sensible.</p>

<form method="post" action="?page=variables">
    <label>Tu apellido:</label>
    <input type="text" name="apellido">
    <input type="submit" value="Enviar">
</form>

<?php if (isset($_POST['apellido'])): ?>
    <p>Tu apellido es: <?= htmlspecialchars($_POST['apellido']); ?></p>
<?php endif; ?>

<hr>

<h3>$_REQUEST</h3>
<p><code>$_REQUEST</code> combina los valores enviados por <code>$_GET</code>, <code>$_POST</code> y <code>$_COOKIE</code>.
Es decir, permite acceder a los datos sin importar cómo fueron enviados. 
Aunque resulta práctica, no se recomienda para datos sensibles, 
porque puede generar confusión sobre el origen real de la información.</p>

<form method="post" action="?page=variables">
    <label>Ciudad:</label>
    <input type="text" name="ciudad">
    <input type="submit" value="Enviar">
</form>

<?php if (isset($_REQUEST['ciudad'])): ?>
    <p>Tu ciudad es: <?= htmlspecialchars($_REQUEST['ciudad']); ?></p>
<?php endif; ?>

<hr>

<h3>$_ENV</h3>
<p><code>$_ENV</code> almacena variables del entorno del sistema operativo o del servidor, 
como el nombre del usuario del sistema o la ruta de instalación de programas.
Estas variables no siempre son visibles, ya que depende de la configuración del servidor o de la directiva 
<code>variables_order</code> del archivo <code>php.ini</code>.</p>

<p>En este entorno de pruebas (Windows + XAMPP), <code>$_ENV</code> puede aparecer vacío por motivos de seguridad.
Por eso, para fines didácticos, <strong>simulamos variables de entorno</strong> con <code>putenv()</code> 
para mostrar cómo PHP puede crear y leer información del entorno, junto con algunas variables reales si están disponibles.</p>

<?php
// Simulamos variables de entorno (demostración práctica)
putenv("USUARIO_PHP=UsuarioDePHP");
putenv("RUTA_PROYECTO=C:/xampp/htdocs/php_investigacion");

// Forzamos su lectura tanto desde getenv() como desde $_ENV
$usuario = getenv('USUARIO_PHP') ?: ($_ENV['USUARIO_PHP'] ?? 'No disponible');
$ruta = getenv('RUTA_PROYECTO') ?: ($_ENV['RUTA_PROYECTO'] ?? 'No disponible');

// También probamos a obtener variables reales, por si el entorno las ofrece
$usuarioReal = getenv('USERNAME') ?: getenv('USER') ?: 'No disponible';
$path = getenv('PATH') ?: 'No disponible';
?>

<ul>
    <li><strong>Usuario simulado (USUARIO_PHP):</strong> <?= htmlspecialchars($usuario); ?></li>
    <li><strong>Ruta del proyecto:</strong> <?= htmlspecialchars($ruta); ?></li>
    <li><strong>Usuario real del sistema:</strong> <?= htmlspecialchars($usuarioReal); ?></li>
    <li><strong>Ruta del sistema (PATH):</strong> <?= substr(htmlspecialchars($path), 0, 80) . '...'; ?></li>
</ul>

<?php include __DIR__ . '/layout/footer.php'; ?>
