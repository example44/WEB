<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CookHub</title>
</head>
<body>
    <header>

    </header>

    <nav>
        <?php include "navigace.php" ?>
    </nav>

    <?php
        if(isset($_COOKIE['user'])):
    ?>
         Privet <?=$_COOKIE['user']?>. Abyste vysel zmacknete <a href="databaze/Controllers/exit.php">zde</a>.
    <?php else :?>
            Ty nevosel
    <?php endif; ?>
</body>
</html>