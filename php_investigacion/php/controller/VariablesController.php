<?php
require_once 'php/model/ServidorModel.php';

class VariablesController {
    public function mostrar() {
        $datos = ServidorModel::getServidorInfo();
        include __DIR__ . '/../views/variablesView.php';
    }
}
?>
