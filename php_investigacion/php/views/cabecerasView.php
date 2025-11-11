<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/menu.php'; ?>

<h2>🛰️ Cabeceras HTTP en PHP</h2>

<p>
Las cabeceras HTTP son mensajes invisibles que el servidor envía al navegador <strong>antes</strong> 
de enviar cualquier contenido.  
Sirven para indicar cómo debe comportarse el cliente: redirigir, definir el tipo de contenido, 
forzar una descarga o controlar la caché, entre otros.  
En PHP, se envían mediante la función <code>header()</code>.  
(<a href="https://www.php.net/manual/es/function.header.php" target="_blank">Referencia oficial</a>)
</p>

<div class="divider"></div>

<h3>📦 Ejemplos de cabeceras comunes</h3>
<ul>
    <li><strong>Redirección:</strong> <code>header("Location: destino.php");</code></li>
    <li><strong>Tipo de contenido:</strong> <code>header("Content-Type: text/plain");</code></li>
    <li><strong>Descarga forzada:</strong> <code>header("Content-Disposition: attachment; filename='archivo.txt'");</code></li>
    <li><strong>Evitar caché:</strong> <code>header("Cache-Control: no-cache, must-revalidate");</code></li>
</ul>

<p class="nota">
⚠️ <em>Importante:</em> según el manual oficial, las cabeceras deben enviarse <strong>antes de imprimir cualquier texto o etiqueta HTML</strong>.  
Si se envían después de empezar la salida del contenido, PHP mostrará un error del tipo 
<code>headers already sent</code>.
</p>

<div class="divider"></div>

<h3>🧪 Demostración práctica</h3>

<form method="post" class="demo-buttons">
    <button type="submit" name="accion" value="texto">📜 Mostrar como texto plano</button>
    <button type="submit" name="accion" value="redirigir">🌐 Redirigir a Google</button>
    <button type="submit" name="accion" value="descargar">📁 Forzar descarga</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    switch ($accion) {
        case 'texto':
            // Cambiar tipo de contenido a texto plano
            header("Content-Type: text/plain");
            echo "Esto es una respuesta de texto plano enviada con header('Content-Type: text/plain')";
            exit;

        case 'redirigir':
            // Redirigir al usuario a otra URL
            header("Location: https://www.google.com");
            exit;

        case 'descargar':
            // Generar un archivo temporal para demostrar la descarga
            $archivo = __DIR__ . "/../../uploads/ejemplo.txt";
            file_put_contents($archivo, "Archivo generado desde PHP para demostrar header('Content-Disposition').");

            // Enviar cabeceras de tipo y descarga
            header("Content-Type: text/plain");
            header("Content-Disposition: attachment; filename='ejemplo.txt'");
            readfile($archivo);
            exit;
    }
}
?>

<div class="divider"></div>

<h3>📘 Buenas prácticas</h3>
<ul>
    <li>Las cabeceras deben enviarse <strong>antes de cualquier salida</strong> al navegador (texto, HTML, echo, etc.).</li>
    <li>Se pueden enviar múltiples cabeceras seguidas; PHP las combina automáticamente en la respuesta HTTP.</li>
    <li>Para eliminar una cabecera previamente enviada, se puede usar <code>header_remove()</code>.</li>
    <li>Algunas cabeceras como <code>Location:</code> obligan a terminar el script con <code>exit</code> tras su envío.</li>
</ul>

<p class="nota">
🔎 Fuente: <a href="https://www.php.net/manual/es/function.header.php" target="_blank">Manual oficial de PHP – Función header()</a>
</p>

<?php include __DIR__ . '/layout/footer.php'; ?>
