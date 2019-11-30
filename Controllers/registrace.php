<?php include "kontrolaRegistrace.php" ?>
<?php if(!isset($_COOKIE['user'])): ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrace</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/styl.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Registrace</h1>
        <form class="prihlaseni" method="post" action="check.php">                           <?php //echo htmlspecialchars($_SERVER["PHP_SELF"])?>
            Username: <input type="text" class="form-control" name="name"  id="name" value="<?php echo $name?>" placeholder="Napište username">
            <span class="error">* <?php echo $nameErr;?></span>
            <br><br>
            Email: <input type="email" class="form-control" name="email" id="emal" value="<?php echo $email?>" placeholder="Napište email">
            <span class="error">* <?php echo $emailErr;?></span>
            <br><br>
            Heslo: <input type="password" class="form-control" name="heslo" id="heslo" value="<?php echo $heslo?>" placeholder="Napište heslo">
            <span class="error">* <?php echo $hesloErr;?></span>
            <br><br>
            Heslo znovu: <input type="password" class="form-control" name="heslo_znovu" id="heslo_znovu" value="<?php echo $heslo_znovu?>" placeholder="Zopakujte heslo">
            <span class="error">* <?php echo $heslo_znovuErr;?></span>
            <br><br>
            <!--<input type="radio" name="role" value="admin">Admin -->
            <input type="radio" class="form-control" name="role" id="role" <?php if(isset($role) && $role == "autor") echo "checked";?> value="autor">Autor
            <input type="radio" class="form-control" name="role"  id="role" <?php if(isset($role) && $role == "recenzent") echo "checked";?> value="recenzent">Recenzent
            <span class="error">* <?php echo $roleErr;?></span>
            <br><br>
            <button class="btn btn-success" type="submit" >Zaregistrovat</button><br>
        </form>
    </div>
</body>
</html>
<?php else: ?>
Nelze se registrovat znovu
<?php endif;?>

