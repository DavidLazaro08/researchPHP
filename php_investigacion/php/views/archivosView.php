<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/menu.php'; ?>

<h2>Gestión de archivos en PHP — $_FILES</h2>

<p><code>$_FILES</code> es una variable superglobal que contiene información sobre los archivos 
enviados mediante un formulario HTML. Cada archivo subido incluye datos como el nombre original, 
tipo MIME, tamaño, nombre temporal y posibles errores durante la subida.</p>

<p>En este ejemplo, podrás seleccionar un archivo y subirlo al servidor. 
El script mostrará sus detalles y lo almacenará en la carpeta <strong>/uploads/</strong>.</p>

<div class="divider"></div>



<form method="post" enctype="multipart/form-data" action="?page=archivos">
    <label for="archivo">Selecciona un archivo:</label>
    <input type="file" name="archivo" id="archivo" required>
    <br><br>
    <input type="submit" value="Subir archivo">
</form>

<?php if ($resultado): ?>
    <hr>
    <h3>Información del archivo subido:</h3>
    <div style="display: flex; align-items: flex-start; gap: 20px;">
        <ul>
            <li><strong>Nombre:</strong> <?= htmlspecialchars($resultado['nombre']); ?></li>
            <li><strong>Tipo MIME:</strong> <?= htmlspecialchars($resultado['tipo']); ?></li>
            <li><strong>Tamaño:</strong> <?= round($resultado['tamano'] / 1024, 2); ?> KB</li>
            <li><strong>Ruta:</strong> <?= htmlspecialchars($resultado['ruta']); ?></li>
            <li><a href="<?= htmlspecialchars($resultado['ruta']); ?>" target="_blank">📂 Abrir archivo</a></li>
        </ul>

        <?php
        // Si el tipo MIME indica que es imagen, mostramos miniatura
        if (str_starts_with($resultado['tipo'], 'image/')): ?>
            <div style="border: 1px solid #ccc; padding: 10px;">
                <img src="<?= htmlspecialchars($resultado['ruta']); ?>" 
                     alt="Vista previa" 
                     style="max-width: 200px; max-height: 200px; object-fit: cover;">
                <p style="text-align: center; font-size: 0.9em;">Vista previa</p>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>


<?php include __DIR__ . '/layout/footer.php'; ?>
