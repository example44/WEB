<?php

require_once "autorizace.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/styl.css">
    <title>Autorizace</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Autorizace</h1>
        <form class="prihlaseni" method="post" action="autorizace.php">                           <?php //echo htmlspecialchars($_SERVER["PHP_SELF"])?>
            Email: <input type="email" class="form-control" name="email" id="emal" value="<?php echo $email?>" placeholder="Napište email">
            <span class="error">* <?php echo $emailErr;?></span>
            <br><br>
            Heslo: <input type="password" class="form-control" name="heslo" id="heslo" value="<?php echo $heslo?>" placeholder="Napište heslo">
            <span class="error">* <?php echo $hesloErr;?></span>
            <br><br>
            <button class="btn btn-success" type="submit" >Vstup</button><br>
        </form>
    </div>
</body>
</html>


