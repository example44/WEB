<?php
require_once "Database.class.php";

$email = $heslo = "";
$emailErr = $hesloErr = "";
$user = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "Vyplňte pole Email";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Špatný format emailu";
        }
    }

    if (empty($_POST["heslo"])) {
        $hesloErr = "Musíte zadat heslo";
    } else {
        $heslo = test_input($_POST["heslo"]);
        if (strlen($heslo < 8)) {
            $hesloErr = "Heslo musí být délší než 8 symbolů";
        }
    }



    $heslo = md5($heslo . "type");
    echo $heslo;
    $myDB = new Database();
    $user = $myDB->selectFromTable(TABLE_UZIVATEL, "email = '$email' AND heslo = '$heslo'");
    if (count($user) == 0) {
        echo ">prejit na hlavni stranku</a>";
        exit();
    } else {
        setcookie('user', $user[0]['email'], time() + 3600, "/");
        header("Location: /Conference/index.php");
    }
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>