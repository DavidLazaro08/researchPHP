<?php
require_once __DIR__ . '/../model/ServidorModel.php';

class VariablesController {
    public function mostrar() {
        // Obtiene información del servidor desde el modelo
        $datos = ServidorModel::getServidorInfo();

        // Carga la vista correspondiente
        include __DIR__ . '/../views/variablesView.php';
    }
}
?>
