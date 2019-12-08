<?php


class Registrace implements IController {
    private $userMan;

    public function __construct(){
        require_once "settings.inc.php";
        require_once DIRECTORY_CONTROLLERS . "/ProPrihlaseny.class.php";
        $this->userMan = new ProPrihlaseny();
    }

    public function show(){
        $tplData = [];
        if(isset($_POST['action']) && $_POST['action'] == "registrace") {
            $dataUziv = $this->kontolRegistrace();
            if($dataUziv['povolit_reg']){
                $res = $this->userMan->addUser($dataUziv['email']['value'], $dataUziv['heslo']['value'], $dataUziv['username']['value'], $dataUziv['role']['value']);
                $tplData.=$dataUziv;
            }else{
                echo "Chyba přihlašení";
            }
            if($res){
                echo "OK: Uživatel byl přidán do databáze.";
            } else {
                echo "ERROR: Uložení uživatele se nezdařilo.";
            }
        }
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
            "povolit_reg" => true

        );

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $result['username']['error'] = "Vypňte pole username";
                $result['povolit_reg'] = false;
            } else {
                $result['username']['value'] = $this->test_input($_POST["name"]);
                if (!preg_match("/^[a-z A-Z ]*$/", $result['username']['value'])) {
                    $result['username']['error'] = "Jsou povolené jen písmena a mezery";
                    $result['povolit_reg'] = false;
                }
            }

            if (empty($_POST["email"])) {
                $result['email']['error'] = "Vypňte pole Email";
                $result['povolit_reg'] = false;
            } else {
                $result['email']['value'] = $this->test_input($_POST["email"]);
                if (!filter_var($result['email']['value'], FILTER_VALIDATE_EMAIL)) {
                    $result['email']['error'] = "Špatný format emailu";
                    $result['povolit_reg'] = false;
                }
            }

            if (empty($_POST["heslo"])) {
                $result['heslo']['error'] = "Musíte zadat heslo";
                $result['povolit_reg'] = false;
            } else {
                $result['heslo']['value'] = $this->test_input($_POST["heslo"]);
                if(strlen($result['heslo']['value'] < 8)){
                    $result['heslo']['error'] = "Heslo musí být délší než 8 symbolů";
                    $result['povolit_reg'] = false;
                }
            }

            if (empty($_POST["role"])) {
                $result['role']['error'] = "Musíte zvolit role";
            }else{
                $result['role']['value'] = $this->test_input($_POST["role"]);
            }

            if (empty($_POST["heslo_znovu"])) {
                $result['heslo_znovu']['error'] = "Musíte zopakovat heslo";
                $result['povolit_reg'] = false;
            } else {
                if($result['heslo']['value'] != $result['heslo_znovu']['value']){
                    $result['heslo_znovu']['error'] = "Heslo není stejně";
                    $result['povolit_reg'] = false;
                }
            }

        }
        return $result;
    }

    private function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

?>