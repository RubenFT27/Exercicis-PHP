<?php
$quant = $_POST["quant"];
$divisa = $_POST["divisa"];

if(isset($quant) && $divisa === "eur") {
    $dol = 1.1381;
    $resul = $quant * $dol;
    echo $quant."€ al canvi a Dolars, equival a ".$resul."$";
}
elseif(isset($quant) && $divisa === "dol") {
    $eur = 0.8787;
    $resul = $quant * $eur;
    echo $quant."$ al canvi a Euros, equival a ".$resul."€";
}
else {
    echo "Intrudueix una quantitat";    
}
echo "<form action='index.html'>
        <input type='submit' value='Tornar'>
        </form>";
?>