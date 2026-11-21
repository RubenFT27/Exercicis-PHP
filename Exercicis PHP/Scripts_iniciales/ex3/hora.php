<?php
$data = date("H");
if ($data >= "5" && $data <= "13") {
    echo "Bon dia!";
}
elseif($data >= "14" && $data <= "19") {
    echo "Bona tarda!";
}
else {
    echo "Bona nit!";
}
echo "<form action='index.html'>
        <input type='submit' value='Tornar'>
        </form>";
?>