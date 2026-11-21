<?php
session_start();
?>

<html>
<head></head>

<body>

    <p><?php echo $_SESSION['user']; ?></p>

    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer condimentum sem a neque suscipit tincidunt. Pellentesque quis eros sit amet est consectetur imperdiet. Mauris ornare eget neque in maximus. Integer dui metus, consequat at maximus vitae, ornare sed erat. Duis vestibulum quam at nibh molestie, quis pharetra felis interdum. Sed ornare libero odio, vel sagittis magna rutrum ut. Maecenas malesuada arcu eu mollis viverra. Morbi quis dolor gravida, fermentum leo ut, facilisis diam. Morbi justo quam, luctus et ante non, egestas accumsan mauris. Sed eu volutpat nulla. Sed elit mi, cursus sed nisl eu, tincidunt posuere velit.

Duis faucibus commodo magna sit amet bibendum. Suspendisse ut nibh metus. Donec fermentum quam in dui molestie, non auctor nibh venenatis. Vivamus laoreet quam non ante suscipit luctus. Proin ut tristique erat, eget lobortis lorem. Vestibulum lacinia dapibus ex eu tincidunt. Vestibulum eu diam a purus imperdiet pellentesque. Sed quis eleifend urna, eu condimentum tortor.

Curabitur a facilisis massa. Nullam magna felis, bibendum a diam vel, semper tempus mi. Phasellus in lectus quis tortor condimentum volutpat. Phasellus bibendum lacus eget dolor varius, non lacinia purus sagittis. Cras vulputate, est vitae elementum feugiat, ante augue laoreet massa, eget elementum mi mi vel erat. Maecenas tincidunt dolor lorem, at sagittis neque aliquam id. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vestibulum quis varius nulla. Phasellus auctor est lorem, eu fringilla ligula aliquet in. Etiam efficitur ullamcorper nisi, a elementum lacus fringilla ac. Integer eu iaculis purus. Aliquam sapien nisl, placerat ac hendrerit sit amet, porta imperdiet nunc. Donec sed ligula a lectus aliquet rhoncus eget ac justo. Nulla lacinia eleifend eleifend.</p>

    <a href="content2.php?<?php echo session_name()."=".session_id(); ?>">Següent pagina</a>

</body>
</html>