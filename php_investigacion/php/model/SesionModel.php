<?php
class SesionModel {

    // Inicia sesión y guarda el nombre de usuario
    public static function iniciarSesion(string $nombre): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['usuario'] = $nombre;
    }

    // Cierra sesión
    public static function cerrarSesion(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
    }

    // Crea cookie
    public static function crearCookie(string $nombre, string $valor, int $duracion = 3600): void {
        setcookie($nombre, $valor, time() + $duracion, "/");
    }

    // Elimina cookie
    public static function eliminarCookie(string $nombre): void {
        setcookie($nombre, '', time() - 3600, "/");
    }

    // Devuelve información de sesión y cookies
    public static function obtenerInfo(): array {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return [
            'sesion' => $_SESSION ?? [],
            'cookies' => $_COOKIE ?? []
        ];
    }
}
?>
