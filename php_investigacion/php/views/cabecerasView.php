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

<h3>🧪 Demostración práctica</h3>

<form method="post" class="demo-buttons">
    <button type="submit" name="accion" value="texto">Mostrar como texto plano</button>
    <button type="submit" name="accion" value="redirigir">Redirigir a Google</button>
    <button type="submit" name="accion" value="descargar">Forzar descarga</button>
</form>

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
