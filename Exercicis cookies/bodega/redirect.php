<?php
$majoredat = $_COOKIE['majoredat'];
$idioma = $_COOKIE['idioma'];
$moneda = $_COOKIE['moneda'];

if($majoredat === "si"){

    if ($idioma === "cat"){
        header("Location: bodega_cat.php");
    }
    elseif ($idioma === "esp"){
        header("Location: bodega_esp.php");
    }
    elseif ($idioma === "eng"){
        header("Location: bodega_eng.php");
    }

    if($moneda === "eur"){
        $valor = 1;
        setcookie("valor", $valor);
        setcookie("simbol", "€");
    }
    elseif($moneda === "dol"){
        $valor = 1.12;
        setcookie("valor", $valor);
        setcookie("simbol", "$");
    }
    elseif($moneda === "lib"){
        $valor = 0.84;
        setcookie("valor", $valor);
        setcookie("simbol", "£");
    }
}
elseif($majoredat === "no"){
    if ($idioma === "cat"){
        header("Location: forbidden_cat.html");
    }
    elseif ($idioma === "esp"){
        header("Location: forbidden_esp.html");
    }
    elseif ($idioma === "eng"){
        header("Location: forbidden_eng.html");
    }
}
?>