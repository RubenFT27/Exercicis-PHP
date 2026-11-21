<?php

$valor = $_COOKIE['valor'];
$simbol = $_COOKIE['simbol'];

?>

<html>

<head></head>

<body>

    <h1>Bienvenido a la bodega</h1>
    <p>Te ofrecemos el vino tinto "Les Terrasses" a un precio de <?php echo ($valor * 35)." ".$simbol; ?></p><br><br>
    <p>Te ofrecemos el vino blanco "El Perro Verde" a un precio de <?php echo ($valor * 25)." ".$simbol; ?></p>

    <form action="index.php">
        <input type="submit" value="Volver">
    </form>
    
</body>
</html>