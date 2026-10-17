<?php
session_start();
?>

<html>
<head></head>

<body>
    <?php 
        if ($_SESSION['birra'] != 0){
            echo "<p> Has comprat ".$_SESSION['birra']." packs de 6 cerveses per un preu de ".($_SESSION['birra'] * 8)."€";
        }

        if ($_SESSION['patates'] != 0){
            echo "<p> Has comprat ".$_SESSION['patates']." bosses de patates per un preu de ".($_SESSION['patates'] * 2)."€";
        }
    ?>
    <form action="paga.php">
        <input type="submit" value="Paga">
    </form>
    <form action="index.html">
        <input type="submit" value="Torna">
    </form>
</body>

</html>