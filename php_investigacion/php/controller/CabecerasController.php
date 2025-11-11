<?php
require_once __DIR__ . '/../model/ServidorModel.php';

class CabecerasController {
    public function mostrar() {
        // Obtiene información del servidor desde el modelo
        $datos = ServidorModel::getServidorInfo();

        // Carga la vista correspondiente
        include __DIR__ . '/../views/cabecerasView.php';
    }
}
?>
