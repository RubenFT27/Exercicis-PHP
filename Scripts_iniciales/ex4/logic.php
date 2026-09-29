<?php
    $estil = $_GET["musica_fav"] ?? null;

    if (isset($_GET)) {
        if ($estil === "rock") {
            echo "Doncs et recomano probar Extremoduro";
        } elseif ($estil === "rumba") {
            echo "Doncs et recomano probar Melendi";
        } elseif ($estil === "electronic") {
            echo "Doncs et recomano probar Armin Van Buuren";
        } elseif ($estil === "flamenco") {
            echo "Doncs et recomano probar El Canelita";
        }
    }
    else {

        echo "Selecciona una opció";
    }

        echo "<form action='index.html'>
        <input type='submit' value='Tornar'>
        </form>";
?>