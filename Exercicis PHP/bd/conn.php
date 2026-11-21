<?php
    $servidor = "localhost";
    $usuario = "root";
    $contrasenya = "";
    $basedatos = "base1";

    $conn = mysqli_connect($servidor, $usuario, $contrasenya, $basedatos)
        or die("Problemas con la conexión");

    if (isset($_REQUEST['nombre'], $_REQUEST['email'], $_REQUEST['codigocurso'])) {
        mysqli_query($conn, "insert into alumnos(nombre, email, codigocurso) "
            . "values ('$_REQUEST[nombre]', '$_REQUEST[email]', '$_REQUEST[codigocurso]')")
            or die("Problemas en el insert: " . mysqli_error($conn));

            echo "Se insertaron los datos";
    }
    mysqli_close($conn);
?>
<html>
    <body>
        <form action="" method="post">
            <input type="text" name="nombre" value=""><br>
            <input type="text" name="email" value=""><br>
            <input type="text" name="codigocurso" value=""><br>
            <input type="submit" value="Enviar">
        </form>
        <a href="select.php">Consultar</a>
    </body>