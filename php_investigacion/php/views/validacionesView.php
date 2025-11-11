<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/menu.php'; ?>

<h2>Validaciones de datos en PHP</h2>

<p>En PHP, las funciones <code>isset()</code>, <code>empty()</code> y <code>filter_input()</code> 
nos permiten validar datos antes de procesarlos. 
Esto evita errores y posibles inyecciones de código no deseadas.</p>

<div class="divider"></div>

<h3>Ejemplo práctico</h3>
<p>Introduce tu nombre y edad para comprobar cómo PHP valida la información:</p>

<form method="post" action="?page=validaciones">
    <label>Nombre:</label>
    <input type="text" name="nombre" placeholder="Escribe tu nombre">
    <br><br>

    <label>Edad:</label>
    <input type="text" name="edad" placeholder="Introduce tu edad">
    <br><br>

    <input type="submit" value="Validar">
</form>

<div class="divider"></div>

<?php if (!empty($resultado['errores'])): ?>
    <h4>❌ Se han encontrado errores:</h4>
    <ul style="color:red;">
        <?php foreach ($resultado['errores'] as $error): ?>
            <li><?= htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    </ul>
<?php elseif (!empty($resultado['mensaje'])): ?>
    <h4 style="color:green;">✅ <?= htmlspecialchars($resultado['mensaje']); ?></h4>
<?php endif; ?>

<div class="divider"></div>

<h3>Explicación teórica</h3>
<ul>
    <li><strong>isset(\$variable):</strong> Devuelve <code>true</code> si la variable está definida y no es <code>null</code>.</li>
    <li><strong>empty(\$variable):</strong> Comprueba si la variable está vacía o es igual a <code>0</code>, <code>""</code> o <code>null</code>.</li>
    <li><strong>filter_input(INPUT_POST, 'campo', FILTER_VALIDATE_INT):</strong> Valida el tipo de dato recibido, 
        por ejemplo, que la edad sea un número entero.</li>
</ul>

<?php include __DIR__ . '/layout/footer.php'; ?>
