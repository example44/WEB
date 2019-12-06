<?php


class Registrace implements IController {
    private $userMan;

    public function __construct(){
        require_once "settings.inc.php";
        require_once DIRECTORY_CONTROLLERS . "/ProPrihlaseny.class.php";
        $this->userMan = new ProPrihlaseny();
    }

    public function show(){
        if(isset($_POST['action']) && $_POST['action'] == "registrace") {
            $res = $this->userMan->addNewUser($_POST['email'], $_POST['heslo'], $_POST['name'], $_POST['role'] );
            if($res){
                echo "OK: Uživatel byl přidán do databáze.";
            } else {
                echo "ERROR: Uložení uživatele se nezdařilo.";
            }
        }


        $tplData = [0];
        return $tplData;
    }

    private function kontolRegistrace(){
        $name = $email = $role = $heslo = $heslo_znovu = "";
        $nameErr = $emailErr = $roleErr = $hesloErr = $heslo_znovuErr = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameErr = "Vypňte pole username";
            } else {
                $name = test_input($_POST["name"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-z A-Z ]*$/",$name)) {
                    $nameErr = "Only letters and white space allowed";
                }
            }

            if (empty($_POST["email"])) {
                $emailErr = "Vypňte pole Email";
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
                if(strlen($heslo < 8)){
                    $hesloErr = "Heslo musí být délší než 8 symbolů";
                }
            }

            if (empty($_POST["role"])) {
                $roleErr = "Musíte zvolit role";
            }else{
                $role = test_input($_POST["role"]);
            }

            if (empty($_POST["heslo_znovu"])) {
                $heslo_znovuErr = "Musíte zopakovat heslo";
            } else {
                $heslo_znovu = $_POST["heslo_znovu"];
                if($heslo != $heslo_znovu){
                    $heslo_znovuErr = "Heslo není stejně.";
                }
            }

        }
    }

    private function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

?>