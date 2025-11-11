<?php
$page = $_GET['page'] ?? 'variables'; // valor por defecto

$controllerFile = "php/controller/" . ucfirst($page) . "Controller.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $className = ucfirst($page) . "Controller";
    $controller = new $className();
    $controller->mostrar();
} else {
    echo "Página no encontrada.";
}
?>
