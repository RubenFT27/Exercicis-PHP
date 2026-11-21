<?php

session_start();
if(!isset($_SESSION['birra'])){
    $_SESSION['birra'] = 0;
}
if(!isset($_SESSION['patates'])){
    $_SESSION['patates']=0;
}

if(!isset($_POST['quant_birra'])){
    header("Location: index.html");
}

if(!isset($_POST['quant_patates'])){
    header("Location: index.html");
}


$quantbirra += isset($_POST['quant_birra']) ? $_POST['quant_birra'] : 0;
$quantpatates += isset($_POST['quant_patates']) ? $_POST['quant_patates'] : 0;

$_SESSION['birra'] += $quantbirra;
$_SESSION['patates'] += $quantpatates;

header("Location: index.html");

?>