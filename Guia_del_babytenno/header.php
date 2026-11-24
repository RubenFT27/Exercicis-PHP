<?php
// Inicia la sesión solo si la página que incluye este header no la ha iniciado ya
// Recordemos que la funcion sessio_status()
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Asegura que BASE_URL esté disponible aunque se llame desde una subcarpeta (guias/, arsenal/, etc.)
require_once __DIR__ . '/config/conexion.php';

// Permite que cada página defina su propio título antes de incluir el header
$titulo_mostrar = isset($titulo_pagina) ? $titulo_pagina . ' - Guía del Babytenno' : 'Guía del Babytenno';

// Comprobamos si hay un usuario autenticado en la sesión
$esta_logueado = isset($_SESSION['usuario_id']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($titulo_mostrar); ?></title>
    <!-- Cargamos el CSS usando BASE_URL para que nunca se rompa desde subcarpetas -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/estilos.css">
</head>
<body>

<header class="cabecera-principal">
    <div class="contenedor-header">
        <!-- Logo / Nombre de la aplicación -->
<!-- Anteriormente se ha definido $esta_logueado como true o false. 
Si esta variable es true, redirige a acces.php, si no, lo hace a index.html -->
        <div class="logo-bloque">
            <a href="<?php echo BASE_URL . ($esta_logueado ? 'acces.php' : 'index.html'); ?>" class="logo-titulo">
                Guía del Babytenno
            </a>
        </div>

        <?php if ($esta_logueado): ?>
            <!-- MENÚ DE NAVEGACIÓN PARA USUARIOS LOGUEADOS -->
            <nav class="menu-navegacion">
                <a href="<?php echo BASE_URL; ?>acces.php">Inicio</a>
                <a href="<?php echo BASE_URL; ?>guias/listar.php">Guías</a>
                <a href="<?php echo BASE_URL; ?>arsenal/mi_arsenal.php">Mi Arsenal</a>
                <a href="<?php echo BASE_URL; ?>mercado/maroo.php">Mercado</a>

                <?php if ($_SESSION['usuario_rol'] === 'lotus' || $_SESSION['usuario_rol'] === 'cefalon'): ?>
                    <a href="<?php echo BASE_URL; ?>guias/categorias.php">Categorías</a>
                <?php endif; ?>

                <?php if ($_SESSION['usuario_rol'] === 'lotus'): ?>
                    <a href="<?php echo BASE_URL; ?>admin/estadisticas.php">Panel Lotus</a>
                <?php endif; ?>
            </nav>

            <!-- DATOS DEL USUARIO ACTIVO Y CIERRE DE SESIÓN -->
            <div class="usuario-info">
                <span>
                    <strong><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></strong>
                    (<?php echo htmlspecialchars($_SESSION['usuario_email']); ?>)
                </span>
                <span class="badge-rol rol-<?php echo htmlspecialchars($_SESSION['usuario_rol']); ?>">
                    <?php echo strtoupper(htmlspecialchars($_SESSION['usuario_rol'])); ?>
                </span>
                <a href="<?php echo BASE_URL; ?>logout.php" class="btn-salir">Cerrar sesión</a>
            </div>

        <?php else: ?>
            <!-- MENÚ BÁSICO PARA VISITANTES SIN SESIÓN -->
            <nav class="menu-navegacion">
                <a href="<?php echo BASE_URL; ?>login.php" class="btn-enlace">Iniciar Sesión</a>
                <a href="<?php echo BASE_URL; ?>registro.php" class="btn-primario">Registrarse</a>
            </nav>
        <?php endif; ?>
    </div>
</header>

<!-- Abrimos el contenedor principal que cada página cerrará al final -->
<main class="contenedor-principal">