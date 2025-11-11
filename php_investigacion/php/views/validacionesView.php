<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/menu.php'; ?>

<h2>✅ Validaciones de datos en PHP</h2>

<p>
Antes de procesar datos del usuario, es fundamental <strong>validarlos</strong> para evitar errores o ataques.  
PHP ofrece funciones específicas como <code>isset()</code>, <code>empty()</code> y <code>filter_input()</code> 
para comprobar la existencia, el contenido y el tipo de dato recibido.  
(<a href="https://www.php.net/manual/es/function.filter-input.php" target="_blank">Manual oficial de <code>filter_input()</code></a>)
</p>

<div class="divider"></div>

<h3>🧪 Ejemplo práctico</h3>
<p>
Introduce tu nombre y edad para ver cómo PHP valida la información antes de procesarla.
</p>

<form method="post" action="?page=validaciones" class="form-sesion">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre">

    <label for="edad">Edad:</label>
    <input type="text" name="edad" id="edad" placeholder="Introduce tu edad">

    <input type="submit" value="Validar">
</form>

<div class="divider"></div>

<?php if (!empty($resultado['errores'])): ?>
    <h4>❌ Se han encontrado errores:</h4>
    <ul style="color: #c0392b; font-weight: 500;">
        <?php foreach ($resultado['errores'] as $error): ?>
            <li><?= htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    </ul>
<?php elseif (!empty($resultado['mensaje'])): ?>
    <h4 style="color: #2e7d32;">✅ <?= htmlspecialchars($resultado['mensaje']); ?></h4>
<?php endif; ?>

<div class="divider"></div>

<h3>📘 Explicación teórica</h3>
<p>
Estas funciones forman la base de la validación en PHP y son ampliamente utilizadas en proyectos reales:
</p>

<ul>
    <li><strong><code>isset($variable)</code>:</strong> devuelve <code>true</code> si la variable está definida y no es <code>null</code>.</li>
    <li><strong><code>empty($variable)</code>:</strong> comprueba si la variable está vacía (valor <code>0</code>, <code>""</code>, <code>null</code> o no definida).</li>
    <li><strong><code>filter_input(INPUT_POST, 'campo', FILTER_VALIDATE_INT)</code>:</strong> 
        valida y filtra datos recibidos desde formularios; por ejemplo, asegura que la edad sea un número entero.</li>
</ul>

<p class="nota">
💡 Consejo: combina <code>isset()</code> y <code>filter_input()</code> para verificar tanto la existencia como la validez del dato.  
Por ejemplo:  
<code>$edad = filter_input(INPUT_POST, 'edad', FILTER_VALIDATE_INT);</code>
</p>

<?php include __DIR__ . '/layout/footer.php'; ?>
