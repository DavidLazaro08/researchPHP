<?php
class EjemploFinalController {
    public static function mostrar() {
        // Si no hay sesión, la iniciamos (necesaria para $_SESSION)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Incluimos la vista del ejemplo final
        include __DIR__ . '/../views/ejemploFinalView.php';
    }
}
