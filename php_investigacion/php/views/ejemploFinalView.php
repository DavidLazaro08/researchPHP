<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/menu.php'; ?>

<h2>🧩 Ejemplo Final — Superglobales en acción</h2>

<p>
En este ejemplo práctico se combinan las principales <strong>variables superglobales</strong> de PHP 
(<code>$_POST</code>, <code>$_SESSION</code>, <code>$_COOKIE</code> y <code>$_SERVER</code>) 
para mostrar cómo interactúan entre sí dentro de un mismo flujo.  
(<a href="https://www.php.net/manual/es/language.variables.superglobals.php" target="_blank">
Referencia oficial</a>)
</p>

<div class="divider"></div>

<h3>🧪 Formulario de prueba</h3>
<p>Completa los campos y observa cómo PHP procesa y recuerda los datos.</p>

<form method="post" action="?page=ejemploFinal" class="form-sesion">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" placeholder="Introduce tu nombre..." 
           value="<?= htmlspecialchars($_SESSION['nombre'] ?? '') ?>">

    <label for="edad">Edad:</label>
    <input type="text" id="edad" name="edad" placeholder="Introduce tu edad..." 
           value="<?= htmlspecialchars($_SESSION['edad'] ?? '') ?>">

    <label for="color">Color favorito:</label>
    <input type="color" id="color" name="color" 
           value="<?= htmlspecialchars($_COOKIE['color'] ?? '#777BB3') ?>">

    <input type="submit" name="guardar" value="Guardar datos">
    <button type="submit" name="borrar" value="1">Borrar sesión y cookie</button>
</form>

<div class="divider"></div>

<?php
// --- PROCESAMIENTO DE DATOS ---
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['borrar'])) {
        session_destroy();
        setcookie('color', '', time() - 3600, '/');
        echo "<h4 style='color:#c0392b;'>🧹 Datos borrados correctamente.</h4>";
    } else {
        $nombre = trim($_POST['nombre'] ?? '');
        $edad = filter_input(INPUT_POST, 'edad', FILTER_VALIDATE_INT);
        $color = $_POST['color'] ?? '#777BB3';
        $errores = [];

        if (empty($nombre)) $errores[] = "El nombre no puede estar vacío.";
        if ($edad === false || $edad < 0) $errores[] = "La edad debe ser un número válido.";

        if (empty($errores)) {
            $_SESSION['nombre'] = $nombre;
            $_SESSION['edad'] = $edad;
            setcookie('color', $color, time() + 3600, '/');
            echo "<h4 style='color:#2e7d32;'>✅ Datos guardados correctamente.</h4>";
        } else {
            echo "<h4 style='color:#c0392b;'>❌ Errores detectados:</h4><ul>";
            foreach ($errores as $e) echo "<li>" . htmlspecialchars($e) . "</li>";
            echo "</ul>";
        }
    }
}
?>

<?php if (!empty($_SESSION) || !empty($_COOKIE)): ?>
<div class="divider"></div>
<h3>📋 Datos almacenados</h3>

<div class="form-cookie" style="max-width:650px;">
    <p><strong>Nombre:</strong> <?= htmlspecialchars($_SESSION['nombre'] ?? '—') ?></p>
    <p><strong>Edad:</strong> <?= htmlspecialchars($_SESSION['edad'] ?? '—') ?></p>
    <p><strong>Color favorito:</strong> 
        <span style="background:<?= htmlspecialchars($_COOKIE['color'] ?? '#ccc') ?>;
        padding:3px 10px; border-radius:6px;">
        <?= htmlspecialchars($_COOKIE['color'] ?? 'No definido') ?>
        </span>
    </p>
</div>

<div class="divider"></div>

<h3>🧠 Información del servidor (via $_SERVER)</h3>
<pre class="console-demo">
Método de solicitud: <?= htmlspecialchars($_SERVER['REQUEST_METHOD']); ?>

Ruta actual: <?= htmlspecialchars($_SERVER['PHP_SELF']); ?>

Agente del cliente: <?= htmlspecialchars($_SERVER['HTTP_USER_AGENT']); ?>

</pre>
<?php endif; ?>

<p class="nota">
💡 Este ejemplo combina <code>$_POST</code> (formulario), <code>$_SESSION</code> (persistencia temporal), 
<code>$_COOKIE</code> (almacenamiento en navegador) y <code>$_SERVER</code> (información del entorno).  
Con ellos se construyen la mayoría de sistemas web dinámicos.
</p>

<?php include __DIR__ . '/layout/footer.php'; ?>
