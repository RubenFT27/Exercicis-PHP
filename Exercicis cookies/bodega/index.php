<?php
if($_POST != ""){
setcookie("majoredat", $_POST['majoredat']);
setcookie("idioma", $_POST['idioma']);
setcookie("moneda", $_POST['moneda']);
}



?>

<html>
    <head></head>
    <body>
        <form action="" method="post">
                <p>Ets major d'edat?</p>
                <select name="majoredat">
                        <option value="si">Si</option>
                        <option value="no">No</option>
                    </select><br>
                <p>Quin idioma parles?</p>
                <select name="idioma">
                        <option value="cat">Catala</option>
                        <option value="esp">Español</option>
                        <option value="eng ">English</option>
                    </select><br>
                <p>Quina moneda fas servir?</p>
                <select name="moneda">
                        <option value="eur">Euros</option>
                        <option value="dol">Dollars</option>
                        <option value="lib">Lliures</option>
                    </select><br><br>
                <input type="submit" value="Envia">
        </form>
    </body>
</html>