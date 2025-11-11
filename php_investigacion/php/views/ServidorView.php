<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/menu.php'; ?>

<h2>🖥️ Variables del servidor y del entorno global — $_SERVER y $GLOBALS</h2>

<p>
En este módulo exploramos dos variables clave del lenguaje PHP:  
<code>$_SERVER</code>, que proporciona información sobre la ejecución del script y el entorno del servidor,  
y <code>$GLOBALS</code>, que permite acceder y modificar variables globales dentro de cualquier función.  
(<a href="https://www.php.net/manual/es/reserved.variables.server.php" target="_blank">Referencia oficial</a>)
</p>

<div class="divider"></div>

<h3>🌐 $_SERVER</h3>
<p>
La superglobal <code>$_SERVER</code> es un <strong>array asociativo</strong> que contiene datos del entorno del servidor,  
del cliente que realiza la petición y del propio script PHP en ejecución.  
Sus valores pueden variar según la configuración del servidor (Apache, Nginx, CLI, etc.).
</p>

<p>
En el siguiente ejemplo mostramos algunos índices habituales con su descripción y el valor real obtenido del entorno actual:
</p>

<?php
$infoServer = [
    'PHP_SELF' => 'Ruta del script actual desde la raíz del servidor',
    'REQUEST_METHOD' => 'Método HTTP usado para acceder a la página (GET, POST...)',
    'SERVER_NAME' => 'Nombre del servidor o dominio donde se ejecuta PHP',
    'HTTP_USER_AGENT' => 'Identificador del navegador o agente del cliente'
];
?>

<table>
    <tr>
        <th>🔑 Índice $_SERVER</th>
        <th>📘 Descripción</th>
        <th>🧩 Valor real</th>
    </tr>
    <?php foreach ($infoServer as $clave => $descripcion): ?>
        <tr>
            <td><code><?= $clave; ?></code></td>
            <td><?= htmlspecialchars($descripcion); ?></td>
            <td><?= htmlspecialchars($_SERVER[$clave] ?? 'No disponible'); ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<p class="nota">
🔎 <em>Nota:</em> según el manual oficial, no todos los servidores devuelven los mismos índices en 
<code>$_SERVER</code>, ya que estos no están estandarizados completamente.
Por ello, se recomienda verificar su existencia con <code>isset()</code> antes de usarlos.
</p>

<div class="divider"></div>

<h3>🌍 $GLOBALS</h3>
<p>
<code>$GLOBALS</code> es un <strong>array especial</strong> que contiene todas las variables globales disponibles en el script actual.  
Permite acceder a ellas incluso desde dentro de una función, sin necesidad de usar la palabra clave <code>global</code>.
</p>

<h4>📖 Ejemplo 1 — Lectura de variables globales</h4>

<?php
$mensaje = "Hola desde el ámbito global!";

function mostrarMensaje() {
    echo "<p><strong>Dentro de la función:</strong> " . 
         htmlspecialchars($GLOBALS['mensaje'] ?? '(variable no disponible)') . "</p>";
}

echo "<p><strong>Fuera de la función:</strong> " . htmlspecialchars($mensaje) . "</p>";
mostrarMensaje();
?>

<div class="divider"></div>

<h4>⚙️ Ejemplo 2 — Modificar variables globales con $GLOBALS (modo demostración paso a paso)</h4>

<?php
$GLOBALS['contador'] = 0;

function incrementarDemo() {
    echo "<pre class='console-demo'>";
    echo "Dentro de la función antes de modificar:\n";
    echo "  \$GLOBALS['contador'] = " . $GLOBALS['contador'] . "\n";
    $GLOBALS['contador']++;
    echo "Después de incrementar:\n";
    echo "  \$GLOBALS['contador'] = " . $GLOBALS['contador'] . "\n";
    echo "</pre>";
}

echo "<p><strong>Valor inicial del contador:</strong> {$GLOBALS['contador']}</p>";
incrementarDemo();
echo "<p><strong>Valor final del contador (tras llamar a la función):</strong> {$GLOBALS['contador']}</p>";
?>

<p class="nota">
💡 En este ejemplo, la salida dentro del bloque <code>&lt;pre&gt;</code> muestra exactamente lo que ocurre “detrás del código”:  
cómo el valor del contador global cambia dentro de la función y afecta directamente a su valor fuera de ella.
</p>

<div class="divider"></div>

<h3>📘 Buenas prácticas</h3>
<ul>
    <li>Evita el uso excesivo de variables globales; dificultan la lectura y depuración del código.</li>
    <li>Usa <code>$GLOBALS</code> solo cuando sea necesario compartir información entre funciones sin parámetros.</li>
    <li>Comprueba siempre la existencia de los índices de <code>$_SERVER</code> con <code>isset()</code>.</li>
</ul>

<?php include __DIR__ . '/layout/footer.php'; ?>
