<?php
$codi = $_POST['codi'];
$contador = $_COOKIE['contador'];
$producte = $_POST['producte'];

if ($producte === "placa"){
    $valor = 350;
    setcookie("prod_formal", "Placa base");
} 
elseif ($producte === "cpu"){
    $valor = 275;
    setcookie("prod_formal", "Processador");

}
elseif ($producte === "gpu"){
    $valor = 690;
    setcookie("prod_formal", "Targeta gràfica");

}
elseif ($producte === "ssd"){
    $valor = 120;
    setcookie("prod_formal", "Disc d'emmagatzenament estandar");

}

if($codi !== null && $codi !== ""){
     if ($codi === "BOTIGA20" && $contador >= 5 && $contador <= 9){
            $contador = 0;
            $valor = $valor * 0.8;
            setcookie("valor", $valor);
            setcookie("contador", $contador); 
            header("Location: compra20.php");
            exit;
     }
     elseif ($codi === "BOTIGA50" && $contador >= 10) {
            $contador = 0;
            $valor = $valor * 0.5;
            setcookie("valor", $valor);
            setcookie("contador", $contador);
            header("Location: compra50.php");
    exit;
        }
        else {
            header("Location: index.php");
            exit;
        }
}
else {
    $contador = 0;
    setcookie("valor", $valor);
    setcookie("contador", $contador);
    header("Location: compra0.php");
    exit;
}

