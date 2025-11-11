<?php
class ArchivosModel {
    public static function subirArchivo($archivo): ?array {
        // Comprobamos si no hubo error en la subida
        if ($archivo['error'] === UPLOAD_ERR_OK) {
            $nombre = basename($archivo['name']);
            $tipo = $archivo['type'];
            $tamano = $archivo['size'];
            $tmp = $archivo['tmp_name'];

            $rutaDestino = __DIR__ . '/../../uploads/' . $nombre;

            // Movemos el archivo del temporal al destino final
            if (move_uploaded_file($tmp, $rutaDestino)) {
                return [
                    'nombre' => $nombre,
                    'tipo' => $tipo,
                    'tamano' => $tamano,
                    'ruta' => 'uploads/' . $nombre
                ];
            }
        }
        return null;
    }
}
?>
