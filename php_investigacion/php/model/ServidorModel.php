<?php
class ServidorModel {
    public static function getServidorInfo(): array {
        return [
            // Si SERVER_ADDR no existe, usamos LOCAL_ADDR o REMOTE_ADDR como alternativa
            'ip' => $_SERVER['SERVER_ADDR'] 
                     ?? $_SERVER['LOCAL_ADDR'] 
                     ?? $_SERVER['REMOTE_ADDR'] 
                     ?? 'No disponible',

            // Si SERVER_SOFTWARE no existe, usamos la versión de PHP como fallback
            'software' => $_SERVER['SERVER_SOFTWARE'] 
                     ?? 'PHP ' . phpversion()
        ];
    }
}
?>
