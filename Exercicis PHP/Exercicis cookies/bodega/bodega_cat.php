<?php

$valor = $_COOKIE['valor'];
$simbol = $_COOKIE['simbol'];

?>

<html>

<head></head>

<body>

    <h1>Benvingut a la bodega</h1>
    <p>T’oferim el vi roig "Les Terrasses" a un preu de <?php echo ($valor * 35)." ".$simbol; ?></p><br><br>
    <p>T’oferim el vi blanc "El Perro Verde" a un preu de <?php echo ($valor * 25)." ".$simbol; ?></p>

    <form action="index.php">
        <input type="submit" value="Retorna">
    </form>

</body>
</html>