<?php
    $nom = $_POST["nombre"] ?? null;
    $email = $_POST["email"] ?? null;
    if ($nom != null && $email != null) {
        $text = "Missatge rebut, ".$nom.". Gràcies per contactar. Et responem a ".$email."";
    } else {
        $text = "";
    }
    echo $text;
?>