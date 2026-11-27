<?php
// Definimos el título de la pestaña antes de cargar la cabecera dinámica
$titulo_pagina = 'Aviso del Sistema';
require_once 'header.php';

// Recogemos el código de error desde la URL (si no llega ninguno, usamos 'desconocido')
$codigo = $_GET['codigo'] ?? 'desconocido';

// Diccionario centralizado de errores agrupados por tipo
$errores = [
    // --- Autenticación y Registro ---
    'campos_vacios'        => 'Todos los campos obligatorios deben estar rellenos.',
    'email_invalido'       => 'El formato del correo electrónico no es válido.',
    'password_corta'       => 'La contraseña debe tener al menos 6 caracteres.',
    'password_no_coincide' => 'Las contraseñas introducidas no coinciden.',
    'email_duplicado'      => 'Ya existe una cuenta registrada con ese correo electrónico.',
    'usuario_no_existe'    => 'No existe ningún usuario registrado con ese correo.',
    'password_incorrecta'  => 'La contraseña introducida no es correcta.',

    // --- Control de Acceso y Roles ---
    'no_logueado'          => 'Debes iniciar sesión para acceder a esta sección.',
    'sin_permisos'         => 'Tu rango actual no tiene permisos para realizar esta acción.',

    // --- Validaciones de Formularios (Guías y Arsenal) ---
    'formato_numero'       => 'Alguno de los valores numéricos introducidos no es válido.',
    'formato_fecha'        => 'La fecha introducida no tiene un formato correcto.',
    'imagen_formato'       => 'Formato de imagen no permitido. Usa únicamente JPG, PNG o WEBP.',
    'imagen_tamano'        => 'La imagen supera el tamaño máximo permitido por el servidor.',
    'imagen_subida'        => 'No se pudo guardar la imagen en el servidor. Inténtalo de nuevo.',

    // --- Integridad Relacional y Base de Datos ---
    'categoria_con_guias'  => 'No se puede eliminar esta categoría porque todavía tiene guías asignadas.',
    'categoria_duplicada'  => 'Ya existe una categoría con ese mismo nombre.',
    'valoracion_duplicada' => 'Ya has enviado una valoración para esta guía anteriormente.',
    'no_encontrado'        => 'El elemento que intentas consultar o modificar no existe.',
    'metodo_invalido'      => 'Acceso no permitido. Debes enviar los datos mediante el formulario.',
    'error_bd'             => 'Ha ocurrido un error interno al comunicarse con la base de datos.'
];

// Buscamos el mensaje exacto; si alguien manipula la URL con un código inventado, mostramos uno genérico
$mensaje_error = $errores[$codigo] ?? 'Ha ocurrido un error inesperado. Por favor, inténtalo de nuevo.';

// Calculamos una ruta segura de retorno (sin usar JavaScript history.back())
$destino_defecto = $esta_logueado ? 'acces.php' : 'index.html';
$volver = $_GET['volver'] ?? '';

// Solo aceptamos rutas internas limpias acabadas en .php (ej: login.php o guias/crear.php)
if (preg_match('/^[a-zA-Z0-9_\/-]+\.php$/', $volver)) {
    $url_retorno = BASE_URL . $volver;
} else {
    $url_retorno = BASE_URL . $destino_defecto;
}
?>

<section class="caja-error">
    <h2>Se ha producido un error</h2>
    <p class="mensaje-error">
        <?php echo htmlspecialchars($mensaje_error); ?>
    </p>
    <p class="codigo-tecnico">
        Código de referencia: <code><?php echo htmlspecialchars($codigo); ?></code>
    </p>
    <div class="acciones-error">
        <a href="<?php echo htmlspecialchars($url_retorno); ?>" class="btn-primario">Volver atrás</a>
    </div>
</section>

</main>

<footer class="pie-pagina">
    <p>Guía del Babytenno &copy; 2026 - Proyecto Final PHP</p>
</footer>

</body>
</html>