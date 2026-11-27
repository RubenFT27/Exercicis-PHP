<?php
// 1. Iniciamos sesión y cargamos la conexión ANTES de imprimir cualquier HTML
session_start();
require_once 'config/conexion.php';

// 2. Si el usuario ya tiene sesión activa, lo enviamos directo a su panel
if (isset($_SESSION['usuario_id'])) {
    header('Location: ' . BASE_URL . 'acces.php');
    exit;
}

// 3. Procesamos el formulario solo cuando llega una petición POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recogemos los datos y quitamos espacios sobrantes al principio y al final
    $nombre           = trim($_POST['nombre'] ?? '');
    $email            = trim($_POST['email'] ?? '');
    $password         = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    // Validación A: Campos obligatorios vacíos
    if ($nombre === '' || $email === '' || $password === '' || $password_confirm === '') {
        header('Location: ' . BASE_URL . 'error.php?codigo=campos_vacios&volver=registro.php');
        exit;
    }

    // Validación B: Formato de correo electrónico correcto
    // Si la constante FILTER_VALIDATE_EMAIL devuelve "false", devuelve el mensaje de error
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: ' . BASE_URL . 'error.php?codigo=email_invalido&volver=registro.php');
        exit;
    }

    // Validación C: Longitud mínima de la contraseña (6 caracteres)
    if (strlen($password) < 6) {
        header('Location: ' . BASE_URL . 'error.php?codigo=password_corta&volver=registro.php');
        exit;
    }

    // Validación D: Comprobar que ambas contraseñas coinciden
    if ($password !== $password_confirm) {
        header('Location: ' . BASE_URL . 'error.php?codigo=password_no_coincide&volver=registro.php');
        exit;
    }

    // Validación E: Comprobar si el email ya está registrado (Sentencia preparada)
    // El "?" de la variable actua como placeholder, este espera que a través de una funcion, 
    // se le asigne un valor. En este caso, es gracias a "mysqli_stmt_bind_param()"
    $sql_check = "SELECT id FROM usuarios WHERE email = ?";
    //mysqli_prepare() prueba a hacer la query pero no devuelve nada de lo que se le pide,
    //tan solo devuelve true si la query es exitosa o false si la misma falla
    $stmt_check = mysqli_prepare($conexion, $sql_check);

    if (!$stmt_check) {
        header('Location: ' . BASE_URL . 'error.php?codigo=error_bd&volver=registro.php');
        exit;
    }
    // Al indicarle a la función el valor 's', se le indica a MySQL que la sintaxis que se le está dando
    // es puramente texto plano. De esta forma se previene la inyección SQL. 
    // Si alguien intentase abrir una subconsulta, esta se buscaria de forma literal, sin ejecutarse.
    mysqli_stmt_bind_param($stmt_check, 's', $email);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);

    //Cuenta cuantas rows ha devuelto la sentencia. Si el numero es mayor que 0,
    //significa que el correo ya existe y redirige al error
    if (mysqli_stmt_num_rows($stmt_check) > 0) {
        mysqli_stmt_close($stmt_check);
        header('Location: ' . BASE_URL . 'error.php?codigo=email_duplicado&volver=registro.php');
        exit;
    }
    mysqli_stmt_close($stmt_check);
    // Se libera la memoria en ambos casos para dejar libre la caché y evitar que ningún dato se cuele en el futuro


    // 4. Encriptamos la contraseña con Bcrypt (PASSWORD_DEFAULT)
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $rol_defecto   = 'babytenno';

    // 5. Insertamos el nuevo usuario en la base de datos (Sentencia preparada)
    $sql_insert = "INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($conexion, $sql_insert);

    if (!$stmt_insert) {
        header('Location: ' . BASE_URL . 'error.php?codigo=error_bd&volver=registro.php');
        exit;
    }

    mysqli_stmt_bind_param($stmt_insert, 'ssss', $nombre, $email, $password_hash, $rol_defecto);

    if (mysqli_stmt_execute($stmt_insert)) {
        mysqli_stmt_close($stmt_insert);
        // Registro correcto: redirigimos al login con un aviso por URL
        header('Location: ' . BASE_URL . 'login.php?registro=ok');
        exit;
    } else {
        mysqli_stmt_close($stmt_insert);
        header('Location: ' . BASE_URL . 'error.php?codigo=error_bd&volver=registro.php');
        exit;
    }
}

// 6. Si no es POST, mostramos la vista HTML con el formulario
$titulo_pagina = 'Registro';
require_once 'header.php';
?>

<section class="caja-formulario">
    <h2>Crear cuenta de Babytenno</h2>
    <p class="subtitulo-form">Únete al Sistema Origen para guardar tu Arsenal y valorar guías.</p>

    <form action="registro.php" method="POST" class="formulario-auth">
        <div class="campo-form">
            <label for="nombre">Nombre de Tenno:</label>
            <input type="text" id="nombre" name="nombre" maxlength="50" required placeholder="Ej: ExcaliburNovato">
        </div>

        <div class="campo-form">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" maxlength="100" required placeholder="tenno@ejemplo.com">
        </div>

        <div class="campo-form">
            <label for="password">Contraseña (mínimo 6 caracteres):</label>
            <input type="password" id="password" name="password" minlength="6" required>
        </div>

        <div class="campo-form">
            <label for="password_confirm">Confirmar contraseña:</label>
            <input type="password" id="password_confirm" name="password_confirm" minlength="6" required>
        </div>

        <button type="submit" class="btn-primario btn-bloque">Registrarme</button>
    </form>

    <p class="enlace-pie-form">
        ¿Ya tienes cuenta? <a href="<?php echo BASE_URL; ?>login.php">Inicia sesión aquí</a>.
    </p>
</section>

</main>

<footer class="pie-pagina">
    <p>Guía del Babytenno &copy; 2026 - Proyecto Final PHP</p>
</footer>

</body>
</html>