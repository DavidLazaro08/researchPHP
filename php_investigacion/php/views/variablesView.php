<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/menu.php'; ?>

<h2>🧩 Variables PHP — $_SERVER, $_GET, $_POST, $_REQUEST y $_ENV</h2>

<p>
Las <strong>variables superglobales</strong> en PHP son <em>arrays asociativos predefinidos</em> 
que permiten intercambiar información entre el cliente, el servidor y el propio entorno del lenguaje.  
Están disponibles en cualquier ámbito del script sin necesidad de ser declaradas mediante <code>global</code>, 
y cada una cumple un papel diferente según el tipo de dato que maneja.  
(Fuente: <a href="https://www.php.net/manual/es/language.variables.superglobals.php" target="_blank">Manual oficial de PHP</a>)
</p>

<div class="divider"></div>

<h3>🌐 $_SERVER</h3>
<p>
<code>$_SERVER</code> contiene información sobre el entorno del servidor: dirección IP, 
software que ejecuta el servidor o el método de solicitud HTTP utilizado.  
Es útil para conocer datos técnicos de la ejecución del script.  
Los índices disponibles dependen del servidor y de su configuración (por ejemplo, Apache o Nginx).
</p>

<ul>
    <li><strong>IP del servidor:</strong> <?= htmlspecialchars($datos['ip']); ?></li>
    <li><strong>Software:</strong> <?= htmlspecialchars($datos['software']); ?></li>
    <li><strong>Método:</strong> <?= htmlspecialchars($_SERVER['REQUEST_METHOD'] ?? 'Desconocido'); ?></li>
    <li><strong>Script actual:</strong> <?= htmlspecialchars($_SERVER['PHP_SELF'] ?? 'No disponible'); ?></li>
</ul>

<p class="nota">
🔎 <em>Según el manual oficial</em>, no todos los servidores proporcionan los mismos valores en <code>$_SERVER</code>, 
ya que estos no están estandarizados completamente (<a href="https://www.php.net/manual/es/reserved.variables.server.php" target="_blank">ver referencia</a>).
</p>

<div class="divider"></div>

<h3>📩 $_GET</h3>
<p>
<code>$_GET</code> se utiliza para recibir información enviada mediante la URL, 
tras el signo <code>?</code>. Los parámetros que se envían son visibles en la barra de direcciones, 
por lo que este método se usa normalmente para <strong>búsquedas o consultas rápidas</strong>.  
Según el manual, este método se usa para <em>peticiones idempotentes</em> (que no modifican el estado del servidor).
</p>

<form method="get" action="?page=variables" class="demo-buttons">
    <label>Tu nombre:</label>
    <input type="text" name="nombre" placeholder="Escribe tu nombre...">
    <button type="submit">Enviar</button>
</form>

<?php if (isset($_GET['nombre'])): ?>
    <p>✅ ¡Hola <strong><?= htmlspecialchars($_GET['nombre']); ?></strong>!</p>
<?php endif; ?>

<div class="divider"></div>

<h3>📝 $_POST</h3>
<p>
<code>$_POST</code> permite enviar información al servidor sin que aparezca en la URL.  
Es el método más habitual para procesar formularios con <strong>datos personales, contraseñas o información sensible</strong>.  
La información se envía en el cuerpo de la solicitud HTTP, por lo que no es visible en la barra de direcciones.  
Según el manual, este método se asocia a <em>peticiones que modifican el estado</em> o almacenan datos en el servidor.
</p>

<form method="post" action="?page=variables" class="demo-buttons">
    <label>Tu apellido:</label>
    <input type="text" name="apellido" placeholder="Escribe tu apellido...">
    <button type="submit">Enviar</button>
</form>

<?php if (isset($_POST['apellido'])): ?>
    <p>✅ Tu apellido es: <strong><?= htmlspecialchars($_POST['apellido']); ?></strong></p>
<?php endif; ?>

<div class="divider"></div>

<h3>🔄 $_REQUEST</h3>
<p>
<code>$_REQUEST</code> combina los valores de <code>$_GET</code>, <code>$_POST</code> y <code>$_COOKIE</code>.  
Su contenido depende de la directiva de configuración <code>request_order</code> o, en su defecto, <code>variables_order</code>.  
Por motivos de seguridad, el manual de PHP recomienda usar directamente <code>$_GET</code> o <code>$_POST</code> 
en lugar de <code>$_REQUEST</code>.
(<a href="https://www.php.net/manual/es/reserved.variables.request.php" target="_blank">Referencia oficial</a>)
</p>

<form method="post" action="?page=variables" class="demo-buttons">
    <label>Ciudad:</label>
    <input type="text" name="ciudad" placeholder="Introduce tu ciudad...">
    <button type="submit">Enviar</button>
</form>

<?php if (isset($_REQUEST['ciudad'])): ?>
    <p>✅ Tu ciudad es: <strong><?= htmlspecialchars($_REQUEST['ciudad']); ?></strong></p>
<?php endif; ?>

<div class="divider"></div>

<h3>⚙️ $_ENV</h3>
<p>
<code>$_ENV</code> contiene variables del entorno del sistema operativo o del servidor, 
como el nombre del usuario del sistema o la ruta de ejecución.  
Estas variables son útiles para almacenar configuraciones que no deben incluirse directamente en el código fuente.  
En muchos entornos (como XAMPP o servidores compartidos), pueden aparecer vacías por motivos de seguridad.
</p>

<p>
En este entorno de pruebas, simulamos variables de entorno con <code>putenv()</code> 
para mostrar cómo PHP puede crear y leer información del entorno, junto con algunas variables reales si están disponibles.  
El orden en que PHP carga estas variables depende de la directiva <code>variables_order</code> del archivo <code>php.ini</code>.  
(<a href="https://www.php.net/manual/es/reserved.variables.environment.php" target="_blank">Referencia oficial</a>)
</p>

<?php
putenv("USUARIO_PHP=UsuarioDePHP");
putenv("RUTA_PROYECTO=C:/xampp/htdocs/php_investigacion");

$usuario = getenv('USUARIO_PHP') ?: ($_ENV['USUARIO_PHP'] ?? 'No disponible');
$ruta = getenv('RUTA_PROYECTO') ?: ($_ENV['RUTA_PROYECTO'] ?? 'No disponible');
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
