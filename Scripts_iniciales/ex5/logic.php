<?php
    $quant = $_POST["quant"];
    $iva = $_POST["iva"];

        if (isset($_POST["quant"]) && isset($_POST["iva"])) {
            if ($_POST["iva"] >= 0 && $_POST["quant"] >= 1) {
                $quant = $_POST["quant"];
                $iva = $_POST["iva"];
                $resul = $quant + ($quant * ($iva / 100));
                echo "El cost del preu ".$quant." aplicant un iva de ".$iva."% resulta en un cost total de: ".$resul;
            } else {
                echo "Introdueix dades valides";
            }
        } else {
            echo "Introdueix dades";
        }
    echo "<form action='index.html'>
    <input type='submit' value='Tornar'>
    </form>";
?>