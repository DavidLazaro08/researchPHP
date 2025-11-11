<?php include __DIR__ . '/layout/header.php'; ?>
<h2>Variables PHP — $_SERVER y $_GET</h2>

<ul>
    <li>IP del servidor: <?= htmlspecialchars($datos['ip']); ?></li>
    <li>Software: <?= htmlspecialchars($datos['software']); ?></li>
</ul>

<form method="get" action="?page=variables">
    <label>Tu nombre:</label>
    <input type="text" name="nombre">
    <input type="submit" value="Enviar">
</form>

<?php if (isset($_GET['nombre'])): ?>
    <p>¡Hola <?= htmlspecialchars($_GET['nombre']); ?>!</p>
<?php endif; ?>

<?php include __DIR__ . '/layout/footer.php'; ?>
