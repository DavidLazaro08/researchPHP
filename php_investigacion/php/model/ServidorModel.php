<?php
class ServidorModel {
    public static function getServidorInfo() {
        return [
            'ip' => $_SERVER['SERVER_ADDR'] ?? 'Desconocido',
            'software' => $_SERVER['SERVER_SOFTWARE'] ?? 'No disponible'
        ];
    }
}
?>
