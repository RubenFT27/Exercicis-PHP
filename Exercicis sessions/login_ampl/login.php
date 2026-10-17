<?php 

    session_start();
    $_SESSION['user'] = $_POST['user'];
    $_SESSION['pwd'] = $_POST['pwd'];

    if ($_POST['user'] != ""){
            if ($_POST['user'] === $_POST['pwd']){
                header("Location: content.php");
            }
            else{
                header("Location: index.html");
            }
        }
    else {
        header("Location: index.html");
    }

?>