<?php


class Autorizace implements IController
{
    private $userMan;


    public function __construct()
    {
        require_once "settings.inc.php";
        require_once DIRECTORY_CONTROLLERS . "/ProPrihlaseny.class.php";
        $this->userMan = new ProPrihlaseny();
    }

    public function show(){
        if(!$this->userMan->isUserLogged()) {
            $tplData = $this->kontolRegistrace();
            if (isset($_POST['action'])) {
                if ($_POST['action'] == 'vstup' && isset($_POST['email']) && isset($_POST['heslo'])) {
                    $dataUziv = $this->kontolRegistrace();
                    $tplData = $dataUziv;
                    $res = $this->userMan->userLogin($_POST['email'], $_POST['heslo']);
                    if ($res) {
                        echo "OK: Uživatel byl přihlášen.";
                    } else {
                        echo "ERROR: Přihlášení uživatele se nezdařilo.";
                    }
                } // odhlaseni
                elseif ($_POST['action'] == 'odhlaseni') {
                    // odhlasim uzivatele
                    $this->userMan->userLogout();
                    echo "OK: Uživatel byl odhlášen.";
                }
            }
            return $tplData;
        } else{
            return null;
        }
    }

    private function kontolRegistrace(){
        $result = array(
            "email" => array( "value" => '', "error" => ''),
            "heslo" => array( "value" => '', "error" => ''),
        );
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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