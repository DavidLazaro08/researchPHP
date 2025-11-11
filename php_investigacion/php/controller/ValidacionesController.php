<?php
require_once __DIR__ . '/../model/ValidacionesModel.php';

class ValidacionesController {
    public function mostrar() {
        $resultado = ValidacionesModel::procesarFormulario();
        include __DIR__ . '/../views/validacionesView.php';
    }
}
?>
