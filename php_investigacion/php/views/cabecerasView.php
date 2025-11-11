<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/menu.php'; ?>

<h2>Cabeceras HTTP en PHP</h2>

<p>
Las cabeceras HTTP son mensajes invisibles que el servidor envía al navegador <strong>antes</strong> del contenido de la página.
Sirven para indicar cómo debe comportarse el navegador: redirigir, descargar un archivo, evitar caché, etc.
En PHP se envían mediante la función <code>header()</code>.
</p>

<hr style="border:none; border-top:1px solid #ccc; margin:20px 0;">

<h3>🔹 Ejemplos de cabeceras comunes</h3>
<ul>
    <li><strong>Redirección:</strong> <code>header("Location: destino.php");</code></li>
    <li><strong>Tipo de contenido:</strong> <code>header("Content-Type: text/plain");</code></li>
    <li><strong>Descarga forzada:</strong> <code>header("Content-Disposition: attachment; filename='archivo.txt'");</code></li>
    <li><strong>Evitar caché:</strong> <code>header("Cache-Control: no-cache, must-revalidate");</code></li>
</ul>

<p>
⚠️ <em>Importante:</em> las cabeceras deben enviarse <strong>antes de imprimir cualquier texto o etiqueta HTML</strong>.
Si se envía una cabecera después del contenido, PHP mostrará un error del tipo <code>headers already sent</code>.
</p>

<hr style="border:none; border-top:1px solid #ccc; margin:20px 0;">

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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    switch ($accion) {
        case 'texto':
            // Cambiamos el tipo de contenido a texto plano
            header("Content-Type: text/plain");
            echo "Esto es una respuesta de texto plano enviada con header('Content-Type: text/plain')";
            exit;

        case 'redirigir':
            // Redirigimos a otra URL
            header("Location: https://www.google.com");
            exit;

        case 'descargar':
            // Generamos un archivo temporal de ejemplo
            $archivo = __DIR__ . "/../../uploads/ejemplo.txt";
            file_put_contents($archivo, "Archivo generado desde PHP para demostrar header('Content-Disposition')");

            header("Content-Type: text/plain");
            header("Content-Disposition: attachment; filename='ejemplo.txt'");
            readfile($archivo);
            exit;
    }
}
?>

<hr style="border:none; border-top:1px solid #ccc; margin:20px 0;">

<h3>📘 Resumen</h3>
<p>
En este ejemplo hemos visto cómo PHP puede controlar el comportamiento del navegador mediante <code>header()</code>:
redirigir, definir el tipo de contenido o forzar descargas.
Esta función es muy potente, pero debe usarse antes de cualquier salida al navegador.
</p>

<?php include __DIR__ . '/layout/footer.php'; ?>
