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
            $res = $this->userMan->addUser($_POST['email'], $_POST['heslo'], $_POST['name'], $_POST['role'] );
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
        $result = array(
            "username" => array( "value" => $_POST['name'],
                                             "error" => ''),
            "email" => array( "value" => $_POST['email'],
                              "error" => ''),
            "role" => array( "value" => $_POST['role'],
                             "error" => ''),
            "heslo" => array( "value" => $_POST['heslo'],
                              "error" => ''),
            "heslo_znovu" => array( "value" => $_POST['heslo_znovu'],
                                    "error" => ''),

        );

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $result['username']['error'] = "Vypňte pole username";
            } else {
                $result['username']['value'] = $this->test_input($_POST["name"]);
                if (!preg_match("/^[a-z A-Z ]*$/", $result['username']['value'])) {
                    $result['username']['error'] = "Jsou povolené jen písmena a mezery";
                }
            }

            if (empty($_POST["email"])) {
                $result['email']['error'] = "Vypňte pole Email";
            } else {
                $result['email']['value'] = $this->test_input($_POST["email"]);
                if (!filter_var($result['email']['value'], FILTER_VALIDATE_EMAIL)) {
                    $result['email']['error'] = "Špatný format emailu";
                }
            }

            if (empty($_POST["heslo"])) {
                $result['heslo']['error'] = "Musíte zadat heslo";
            } else {
                $result['heslo']['value'] = $this->test_input($_POST["heslo"]);
                if(strlen($result['heslo']['value'] < 8)){
                    $result['heslo']['error'] = "Heslo musí být délší než 8 symbolů";
                }
            }

            if (empty($_POST["role"])) {
                $result['role']['error'] = "Musíte zvolit role";
            }else{
                $result['role']['value'] = $this->test_input($_POST["role"]);
            }

            if (empty($_POST["heslo_znovu"])) {
                $result['heslo_znovu']['error'] = "Musíte zopakovat heslo";
            } else {
                if($result['heslo']['value'] != $result['heslo_znovu']['value']){
                    $result['heslo_znovu']['error'] = "Heslo není stejně";
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