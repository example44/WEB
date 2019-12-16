<?php


class Registrace implements IController {
    private $userMan;
    private $tplData;

    public function __construct(){
        require_once "settings.inc.php";
        require_once DIRECTORY_CONTROLLERS . "/ProPrihlaseny.class.php";
        $this->userMan = new ProPrihlaseny();
        $this->tplData = array(
            "username" => array( "value" => '', "error" => ''),
            "email" => array( "value" => '', "error" => ''),
            "role" => array( "value" => '', "error" => ''),
            "heslo" => array( "value" => '', "error" => ''),
            "heslo_znovu" => array( "value" => '', "error" => ''),
            "role_mozne" => $this->userMan->getAllRightsForRegist(),
            "povolit_reg" => true
        );
    }

    public function show(){
        if(!$this->userMan->isUserLogged()) {
            $this->tplData['uzivatel']['role'] = 0;
            if (isset($_POST['action']) && $_POST['action'] == "registrace") {
               $this->kontolRegistrace();
                if ($this->tplData['povolit_reg']) {
                    $this->userMan->addUser($this->tplData['email']['value'], $this->tplData['heslo']['value'], $this->tplData['username']['value'], $this->tplData['role']['value']);
                    $GLOBALS['alert'] = "OK: Uživatel byl založen.";
                } else {
                    $GLOBALS['alert'] = "CHYBA: Založení uživatele se nezdařilo.";
                }
            }
        }
        return $this->tplData;
    }

    private function kontolRegistrace(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $this->tplData['username']['error'] = "Vypňte pole username";
                $this->tplData['povolit_reg'] = false;
            } else {
                $this->tplData['username']['value'] = $this->test_input($_POST["name"]);
                if (!preg_match("/^[a-z A-Z]*$/", $this->tplData['username']['value']) && substr_count($this->tplData['username']['value'], " ")) {
                    $this->tplData['username']['error'] = "Nejsou povolené mezery";
                    $this->tplData['povolit_reg'] = false;
                }
            }

            if (empty($_POST["email"])) {
                $this->tplData['email']['error'] = "Vypňte pole Email";
                $this->tplData['povolit_reg'] = false;
            } else {
                $this->tplData['email']['value'] = $this->test_input($_POST["email"]);
                if (!filter_var($this->tplData['email']['value'], FILTER_VALIDATE_EMAIL)) {
                    $this->tplData['email']['error'] = "Špatný format emailu";
                    $this->tplData['povolit_reg'] = false;
                }
            }

            if (empty($_POST["heslo"])) {
                $this->tplData['heslo']['error'] = "Musíte zadat heslo";
                $this->tplData['povolit_reg'] = false;
            } else {
                $this->tplData['heslo']['value'] = $this->test_input($_POST["heslo"]);
                if(strlen($this->tplData['heslo']['value']) < 8 || strlen($this->tplData['heslo']['value']) > 40){
                    $this->tplData['heslo']['error'] = "Heslo musí být délší než 8 symbolů a kratší než 40";
                    $this->tplData['povolit_reg'] = false;
                }
            }

            if (empty($_POST["role"])) {
                $this->tplData['role']['error'] = "Musíte zvolit role";
                $this->tplData['povolit_reg'] = false;
            }else{
                $this->tplData['role']['value'] = $this->test_input($_POST["role"]);
                for($i = 0; $i < count($this->tplData['role_mozne']); $i++){
                    if($this->tplData['role']['value'] == $this->tplData['role_mozne'][$i]['id_ROLE']){
                        $this->tplData['role']['error'] = '';
                        $this->tplData['povolit_reg'] = true;
                        break;
                    }else{
                        $this->tplData['role']['error'] = "Špatná role";
                        $this->tplData['povolit_reg'] = false;
                    }
                }
            }

            $this->tplData['heslo_znovu']['value'] = $_POST['heslo_znovu'];

            if (empty($_POST["heslo_znovu"])) {
                $this->tplData['heslo_znovu']['error'] = "Musíte zopakovat heslo";
                $this->tplData['povolit_reg'] = false;
            } elseif($this->tplData['heslo']['value'] != $this->tplData['heslo_znovu']['value']){
                    $this->tplData['heslo_znovu']['error'] = "Heslo není stejně";
                    $this->tplData['povolit_reg'] = false;
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