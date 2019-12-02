<!--<!doctype html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport"-->
<!--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->
<!--    <meta http-equiv="X-UA-Compatible" content="ie=edge">-->
<!--    <title>Registrace</title>-->
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="../../css/styl.css">-->
<!--</head>-->
<!--<body>-->
<?php
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['registrace']['title']);
?>
<div class="container mt-4">
        <h1>Registrace</h1>
            <form class="prihlaseni" method="post" action="">                           <?php //echo htmlspecialchars($_SERVER["PHP_SELF"])?>
                Username: <input type="text" class="form-control" name="name"  id="name" value="" placeholder="Napište username">
                <br><br>
                Email: <input type="email" class="form-control" name="email" id="emal" value="" placeholder="Napište email">
                <br><br>
                Heslo: <input type="password" class="form-control" name="heslo" id="heslo" value="" placeholder="Napište heslo">
                <br><br>
                Heslo znovu: <input type="password" class="form-control" name="heslo_znovu" id="heslo_znovu" value="" placeholder="Zopakujte heslo">
                <br><br>
                <!--<input type="radio" name="role" value="admin">Admin -->
                <input type="radio" class="form-control" name="role" id="role" value="autor">Autor
                <input type="radio" class="form-control" name="role"  id="role"  value="recenzent">Recenzent
                <br><br>
                <button class="btn btn-success" type="submit" >Zaregistrovat</button><br>
            </form>
</div>
<?php
    $temp->getHTMLFooter();
?>
<!--    </div>-->
<!--</body>-->
<!--</html>-->

