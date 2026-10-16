<?php

$contador = 1;
$missatge_codi = "";

if(isset($_COOKIE['contador'])){
        $contador = $_COOKIE['contador'];
}
setcookie("contador", $contador+1);
?>
<html>
</head>
<body>
    <?php
    if ($contador >= 5 && $contador <= 9){
        echo "Oferta exclusiva! Utilitza el codi BOTIGA20 per obtenir un 20% de descompte en les teves primeres compres a la botiga";
    }
    elseif($contador >= 10){
        echo "Oferta exclusiva sols per a tu! Utilitza el codi BOTIGA50 per obtenir un 50% de descompte en les teves primeres compres a la botiga";
    }
    echo "<br><br>";
    echo "Has visitat aquesta web ".$contador." vegades";
    ?>
    <form action="comptador_visites.php" method="post">
            <select name="producte">
                    <option value="placa">Placa base estandar: 350€</option>
                    <option value="cpu">Processador estandar: 275€</option>
                    <option value="gpu">Targeta gràfica estandar: 690€</option>
                    <option value="ssd">Disc dur estandar: 120€</option>
                </select><br>
            <input type="text" name="codi">
            <input type="submit" value="COMPRA">
    </form>
</body>