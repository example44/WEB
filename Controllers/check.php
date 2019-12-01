<?php
    require_once "kontrolaRegistrace.php";
    require_once "Database.class.php";

    $myDB = new Database();
    $heslo = md5($heslo."type");
    $myDB->addNewUser($email, $heslo, $name);

    header('Location: /Conference/index.php');
?>