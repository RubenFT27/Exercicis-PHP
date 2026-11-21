<?php

$valor = $_COOKIE['valor'];
$simbol = $_COOKIE['simbol'];

?>

<html>

<head></head>

<body>

    <h1>Welcome to the winery</h1>
    <p>We offer you the red wine "Les Terrasses" at a price of <?php echo ($valor * 35)." ".$simbol; ?></p><br><br>
    <p>We offer you the white wine "El Perro Verde" at a price of <?php echo ($valor * 25)." ".$simbol; ?></p>

    <form action="index.php">
        <input type="submit" value="Go Back">
    </form>

</body>
</html>