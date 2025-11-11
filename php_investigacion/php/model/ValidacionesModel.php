<?php
class ValidacionesModel {

    public static function procesarFormulario() {
        $datos = [
            'nombre' => '',
            'edad' => '',
            'mensaje' => '',
            'errores' => []
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Validamos campo "nombre"
            if (isset($_POST['nombre']) && !empty(trim($_POST['nombre']))) {
                $datos['nombre'] = htmlspecialchars($_POST['nombre']);
            } else {
                $datos['errores'][] = "El campo 'Nombre' es obligatorio.";
            }

            // Validamos campo "edad"
            $edad = filter_input(INPUT_POST, 'edad', FILTER_VALIDATE_INT);
            if ($edad !== false && $edad !== null) {
                $datos['edad'] = $edad;
            } else {
                $datos['errores'][] = "Debe introducir una edad válida (número entero).";
            }

            // Si no hay errores, generamos mensaje
            if (empty($datos['errores'])) {
                $datos['mensaje'] = "Formulario validado correctamente. ¡Hola {$datos['nombre']}! Tienes {$datos['edad']} años.";
            }
        }

        return $datos;
    }
}
?>
