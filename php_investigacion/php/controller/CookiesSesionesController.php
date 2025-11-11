<?php
require_once __DIR__ . '/../model/SesionModel.php';

class CookiesSesionesController {
    public function mostrar() {
        // Inicializamos resultado
        $mensaje = '';

        // Si se envió formulario de sesión
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['nombre_usuario'])) {
                $nombre = trim($_POST['nombre_usuario']);
                SesionModel::iniciarSesion($nombre);
                $mensaje = "¡Sesión iniciada para $nombre!";
            }
            if (isset($_POST['cerrar_sesion'])) {
                SesionModel::cerrarSesion();
                $mensaje = "Sesión cerrada.";
            }
            if (isset($_POST['crear_cookie'])) {
                $cookie = trim($_POST['nombre_cookie']);
                $valor = trim($_POST['valor_cookie']);
                SesionModel::crearCookie($cookie, $valor);
                $mensaje = "Cookie '$cookie' creada con valor '$valor'.";
            }
            if (isset($_POST['eliminar_cookie'])) {
                $cookie = trim($_POST['nombre_cookie_eliminar']);
                SesionModel::eliminarCookie($cookie);
                $mensaje = "Cookie '$cookie' eliminada.";
            }
        }

        include __DIR__ . '/../views/cookiesSesionesView.php';
    }
}
?>
