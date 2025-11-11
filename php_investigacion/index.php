<?php
// index.php — router mínimo
declare(strict_types=1);

// Página por defecto
$page = $_GET['page'] ?? 'inicio';

// Construye ruta al controlador (p.ej. variables → php/controller/VariablesController.php)
$controllerFile = __DIR__ . "/php/controller/" . ucfirst($page) . "Controller.php";

// Si existe el controlador, lo carga y ejecuta su método mostrar()
if (is_file($controllerFile)) {
    require_once $controllerFile;
    $className = ucfirst($page) . "Controller";
    if (class_exists($className)) {
        $controller = new $className();
        $controller->mostrar();
        exit;
    }
}

// Si no hay controlador o clase, carga la vista de inicio
$inicioView = __DIR__ . "/php/views/inicioView.php";
if (is_file($inicioView)) {
    include $inicioView;
} else {
    // Fallback por si aún no existe la vista de inicio
    echo "<h1>Manual Interactivo PHP</h1><p>Crea php/views/inicioView.php</p>";
}
