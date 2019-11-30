<?php
    setcookie('user', $user[0]['email'], time() - 3600, "/");
    header("Location: /Conference/index.php");
?>
