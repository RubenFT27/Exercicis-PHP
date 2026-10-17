<?php
session_start();
$_SESSION = array();
session_destroy();
?>

<html>
<head></head>

<body>
    <h2> Gracies per la seva compra!</h2>
    <form action="index.html">
        <input type="submit" value="Tornar">
    </form>
</body>

</html>