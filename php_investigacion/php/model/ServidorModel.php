<?php
class ServidorModel {
    public static function getServidorInfo(): array {
        return [
            'ip' => $_SERVER['SERVER_ADDR'] 
                     ?? $_SERVER['LOCAL_ADDR'] 
                     ?? $_SERVER['REMOTE_ADDR'] 
                     ?? 'No disponible',
            'software' => $_SERVER['SERVER_SOFTWARE'] 
                     ?? phpversion()
                     ?? 'No disponible'
        ];
    }
}
?>
