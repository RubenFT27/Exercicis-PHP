<?php
$producte = $_COOKIE['prod_formal'];
$valor = $_COOKIE['valor'];
?>

<html>
<head></head>
<body>

    <h1>Moltes gracies per la teva compra!</h1>
    <p>Has utilitzat el teu codi de descompte! Descompte del 50% aplicat!</p>
    <?php
    echo "S'ha fet un carreg de ".$valor."€ al teu compte per la compra de: ".$producte;
    ?>
    <form action="index.php" method="post">
            <input type="submit" value="Torna a la pagina de compra">
    </form>
</body>

</html>