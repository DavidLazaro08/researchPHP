<?php
require_once __DIR__ . '/../model/ArchivosModel.php';

class ArchivosController {
    public function mostrar() {
        $resultado = null;

        // Si el formulario se ha enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo'])) {
            $resultado = ArchivosModel::subirArchivo($_FILES['archivo']);
        }

        include __DIR__ . '/../views/archivosView.php';
    }
}
?>
