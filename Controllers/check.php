<?php
    require_once "kontrolaRegistrace.php";
    require_once "MyDataBaze.class.php";

    $myDB = new MyDatabaze();
    $heslo = md5($heslo."type");
    $myDB->addNewUser($email, $heslo, $name);

    header('Location: /Conference/index.php');
?>