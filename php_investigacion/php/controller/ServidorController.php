<?php
require_once __DIR__ . '/../model/ServidorModel.php';

class ServidorController {
    public function mostrar() {
        // Recuperamos algunos datos del servidor
        $info = ServidorModel::getServidorInfo();

        include __DIR__ . '/../views/servidorView.php';
    }
}
?>
