<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/menu.php'; ?>

<h2>📁 Gestión de archivos en PHP — $_FILES</h2>

<p>
La variable superglobal <code>$_FILES</code> es un <strong>array asociativo multidimensional</strong> 
que contiene información sobre los archivos enviados mediante un formulario HTML.  
Cada campo del formulario genera un subarray con los índices:
<code>name</code>, <code>type</code>, <code>size</code>, <code>tmp_name</code> y <code>error</code>.
</p>

<p>
Para que la subida funcione correctamente, el formulario debe incluir el atributo 
<code>enctype="multipart/form-data"</code> y el método <code>POST</code>.  
El archivo se guarda temporalmente en el servidor bajo <code>tmp_name</code>, y se mueve a su destino definitivo 
usando <code>move_uploaded_file()</code>.  
(Fuente: <a href="https://www.php.net/manual/es/reserved.variables.files.php" target="_blank">Manual oficial de PHP</a>)
</p>

<div class="divider"></div>

<h3>🧪 Subida de archivo</h3>

<form method="post" enctype="multipart/form-data" action="?page=archivos" class="form-subida">
    <label for="archivo">Selecciona un archivo:</label>
    <input type="file" name="archivo" id="archivo" required>
    <button type="submit">📤 Subir archivo</button>
</form>

<?php if ($resultado): ?>
    <div class="divider"></div>

    <h3>📋 Información del archivo subido</h3>
    <div class="resultado-subida">
        <ul>
            <li><strong>Nombre:</strong> <?= htmlspecialchars($resultado['nombre']); ?></li>
            <li><strong>Tipo MIME:</strong> <?= htmlspecialchars($resultado['tipo']); ?></li>
            <li><strong>Tamaño:</strong> <?= round($resultado['tamano'] / 1024, 2); ?> KB</li>
            <li><strong>Ruta temporal:</strong> <?= htmlspecialchars($resultado['tmp']); ?></li>
            <li><strong>Error:</strong> <?= htmlspecialchars($resultado['error'] ?? 'Ninguno'); ?></li>
            <li><strong>Ruta final:</strong> <?= htmlspecialchars($resultado['ruta']); ?></li>
            <li><a href="<?= htmlspecialchars($resultado['ruta']); ?>" target="_blank">📂 Abrir archivo</a></li>
        </ul>

        <?php if (str_starts_with($resultado['tipo'], 'image/')): ?>
            <div class="miniatura">
                <img src="<?= htmlspecialchars($resultado['ruta']); ?>" alt="Vista previa">
                <p>Vista previa</p>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

<div class="divider"></div>

<h3>⚙️ Notas importantes</h3>
<ul>
    <li>El tamaño máximo permitido depende de las directivas <code>upload_max_filesize</code> y <code>post_max_size</code> en <code>php.ini</code>.</li>
    <li>Antes de procesar el archivo, se recomienda validar el índice <code>error</code> y comprobar con <code>is_uploaded_file()</code> que proviene de una subida HTTP válida.</li>
    <li>Usa siempre <code>move_uploaded_file()</code> para guardar el archivo de forma segura en el destino final.</li>
</ul>

<?php include __DIR__ . '/layout/footer.php'; ?>
