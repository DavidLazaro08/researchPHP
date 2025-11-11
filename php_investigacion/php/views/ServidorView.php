<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/menu.php'; ?>

<h2>Variables globales del servidor — $_SERVER y $GLOBALS</h2>

<p>En este módulo veremos cómo PHP maneja las variables globales internas del sistema. 
Mientras que en el bloque anterior las superglobales (<code>$_GET</code>, <code>$_POST</code>, etc.) 
se usaban para intercambiar información con el usuario, 
aquí nos centramos en aquellas que permiten conocer el entorno del servidor y 
acceder a variables globales dentro del propio código.</p>

<div class="divider"></div>

<h3>1. $_SERVER (ampliación)</h3>
<p><code>$_SERVER</code> contiene información sobre la ejecución del script y el entorno del servidor web. 
En la práctica, esto significa que PHP sabe en todo momento:
el archivo que se está ejecutando, el método HTTP que lo llamó, 
el nombre del servidor y el tipo de navegador que está accediendo.</p>

<p>En el siguiente ejemplo mostramos algunos de sus índices más comunes:</p>

<?php
// Preparamos un pequeño array explicativo
$infoServer = [
    'PHP_SELF' => 'Ruta del script actual desde la raíz del servidor',
    'REQUEST_METHOD' => 'Método HTTP usado para acceder a la página (GET, POST...)',
    'SERVER_NAME' => 'Nombre del servidor o dominio donde se ejecuta PHP',
    'HTTP_USER_AGENT' => 'Identificador del navegador del cliente'
];
?>

<table border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse;">
    <tr>
        <th>Índice $_SERVER</th>
        <th>Descripción</th>
        <th>Valor real</th>
    </tr>
    <?php foreach ($infoServer as $clave => $descripcion): ?>
        <tr>
            <td><code><?= $clave; ?></code></td>
            <td><?= $descripcion; ?></td>
            <td><?= htmlspecialchars($_SERVER[$clave] ?? 'No disponible'); ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<p style="margin-top: 10px; font-style: italic;">
Cada valor mostrado proviene directamente del servidor o del navegador.
Por ejemplo, <code>$_SERVER['PHP_SELF']</code> indica el archivo que se está ejecutando en este momento,
y <code>$_SERVER['HTTP_USER_AGENT']</code> nos revela el tipo de navegador que ha hecho la petición.
</p>

<hr>

<h3>2. $GLOBALS</h3>
<p><code>$GLOBALS</code> es un array especial que contiene todas las variables globales disponibles en el script actual.
Permite acceder a ellas incluso desde dentro de una función, sin necesidad de usar la palabra clave <code>global</code>.</p>

<p>En este ejemplo, definiremos una variable global y la mostraremos dentro de una función usando <code>$GLOBALS</code>:</p>

<?php
// ----------------------
// EJEMPLO 1: LECTURA
// ----------------------

// Declaramos una variable en el ámbito global
$mensaje = "Hola desde el ámbito global!";

function mostrarMensaje() {
    // Accedemos desde dentro de la función usando $GLOBALS
    echo "<p><strong>Dentro de la función:</strong> " . htmlspecialchars($GLOBALS['mensaje'] ?? '(variable no disponible)') . "</p>";
}

// Mostramos el valor fuera de la función
echo "<p><strong>Fuera de la función:</strong> " . htmlspecialchars($mensaje) . "</p>";

// Llamamos a la función
mostrarMensaje();
?>

<div class="divider"></div>

<h3>Modificando variables globales con $GLOBALS</h3>
<p>También podemos usar <code>$GLOBALS</code> para modificar variables definidas fuera de la función.
En este ejemplo, la función cambiará el valor de la variable global <code>$contador</code>:</p>

<?php
/*
    EJEMPLO COMPLETO SIN WARNING
    ----------------------------
    Explicación:
    - Declaramos $contador en el ámbito global.
    - Creamos una función que accede a ella con $GLOBALS.
    - Todo el bloque se ejecuta secuencialmente en un único contexto PHP.
*/

// 1. Declaramos la variable global
$GLOBALS['contador'] = 0;

// 2. Definimos la función que la modifica
function incrementar() {
    // Accedemos y modificamos directamente la variable global
    $GLOBALS['contador']++;
    echo "<p><strong>Contador dentro de la función:</strong> " . $GLOBALS['contador'] . "</p>";
}

// 3. Mostramos el valor inicial
echo "<p><strong>Valor inicial del contador:</strong> " . $GLOBALS['contador'] . "</p>";

// 4. Llamamos a la función (incrementa el valor)
incrementar();

// 5. Mostramos el valor final
echo "<p><strong>Valor final del contador (tras llamar a la función):</strong> " . $GLOBALS['contador'] . "</p>";
?>

<p style="margin-top: 10px;">
En este caso, al haber definido la variable directamente dentro del array <code>$GLOBALS</code>, 
nos aseguramos de que exista desde el inicio del script. 
Esto evita los avisos de “undefined variable” y demuestra cómo las funciones pueden modificar 
variables globales sin necesidad de usar la palabra reservada <code>global</code>.
</p>

<?php include __DIR__ . '/layout/footer.php'; ?>
