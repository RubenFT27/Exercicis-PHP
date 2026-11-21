<?php
session_start();
?>

<html>
<head></head>

<body>

    <p><?php echo $_SESSION['user']; ?></p>

    <p>Vivamus sapien enim, varius sed viverra eget, semper quis magna. Aenean nunc tellus, mollis tempus metus sit amet, fringilla pellentesque nisl. Nam pretium, urna a consectetur ornare, nulla ipsum suscipit leo, sodales vestibulum ligula nulla non nulla. Suspendisse ipsum purus, vestibulum at finibus in, rhoncus in enim. Integer ut libero sed massa gravida tristique. Nam eleifend urna sit amet rutrum scelerisque. Quisque pellentesque gravida diam varius faucibus. Aliquam sit amet lorem nisl.

Fusce velit urna, laoreet sed posuere eu, cursus at metus. Fusce porta felis enim, non tempus ipsum luctus imperdiet. Praesent quis dignissim justo, quis fermentum nisi. Phasellus ullamcorper elementum nisl eget porta. Praesent nec dolor sit amet ante elementum consequat eget eget eros. Vestibulum arcu leo, ultrices et sapien ac, imperdiet commodo ante. Cras lobortis libero venenatis mi sagittis, eget aliquam mi hendrerit. Fusce vitae libero a mauris aliquet dictum. Ut viverra tincidunt velit nec tristique. Nulla gravida vitae turpis non congue. Nunc eleifend scelerisque dui.</p>

    <a href="content.php?<?php echo session_name()."=".session_id(); ?>">Torna a l'anterior pagina</a>

</body>
</html>
