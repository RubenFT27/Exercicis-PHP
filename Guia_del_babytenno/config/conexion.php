<?php
// =======================================================
// ARCHIVO: config/conexion.php
// FUNCIÓN: Establece la conexión segura con MySQL usando mysqli
//          y define la ruta base del proyecto.
// =======================================================

// 1. Ruta base del proyecto para que enlaces, CSS y redirecciones
//    funcionen igual desde la raíz o desde subcarpetas (guias/, arsenal/, etc.)
//    (Ajusta '/guia_babytenno/' si tu carpeta en htdocs se llama distinto)
//

//    Las tres siguientes lineas definen una variable global en todo el proyecto "BASE_URL",
//    la cual almacena la ruta del proyecto, de esta forma es posible invocar la conexión 
//    reduciendo los riesgos de equivocarse al escribir la ruta de la base de datos

$ruta_proyecto = str_replace('\\', '/', dirname(__DIR__));
$ruta_servidor = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
define('BASE_URL', str_replace($ruta_servidor, '', $ruta_proyecto) . '/');


// 2. Credenciales de acceso a la base de datos local
$servidor   = 'localhost';
$usuario    = 'root';
$password   = ''; 
$base_datos = 'guia_babytenno';

// 3. Evita que PHP 8.1+ lance un error fatal sin controlar antes de nuestro 'if'
mysqli_report(MYSQLI_REPORT_OFF);

// 4. Abrimos la conexión con el servidor MySQL
$conexion = mysqli_connect($servidor, $usuario, $password, $base_datos);

// 5. Comprobamos si la conexión ha fallado
if (!$conexion) {
    // Detiene la ejecución y muestra el motivo exacto del fallo en desarrollo
    die('Error de conexión con la base de datos: ' . mysqli_connect_error());
}

// 6. Forzamos la codificación UTF-8 completa (tildes, eñes, símbolos)
//    para que coincida con el utf8mb4 de nuestro database.sql
mysqli_set_charset($conexion, 'utf8mb4');
?>