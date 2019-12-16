<?php


class Autorizace implements IController
{
    private $userMan;
    private $tplData;


    public function __construct(){
        require_once "settings.inc.php";
        require_once DIRECTORY_CONTROLLERS . "/ProPrihlaseny.class.php";
        $this->userMan = new ProPrihlaseny();
        $this->tplData = array(
            "email" => array( "value" => '', "error" => ''),
            "heslo" => array( "value" => '', "error" => ''),
            "uzivatel" => array()
        );
    }

    public function show(){
        if(!$this->userMan->isUserLogged()) {
            $this->tplData['uzivatel']['role'] = 0;
            if (isset($_POST['action'])) {
                if ($_POST['action'] == 'vstup' && isset($_POST['email']) && isset($_POST['heslo'])) {
                    $this->kontolAutorizace();
                    $res = $this->userMan->userLogin($this->tplData['email']['value'], $this->tplData['heslo']['value']);
                    if ($res) {
                        $GLOBALS['alert'] = "OK: Uživatel byl přihlášen.";
                        header("Location: index.php?page=uvodni");
                    } else {
                        $GLOBALS['alert'] = "CHYBA: Přihlášení uživatele se nezdařilo.";
                    }
                }
            }
        }
        return $this->tplData;
    }

    private function kontolAutorizace(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["email"])) {
                $this->tplData['email']['error'] = "Vypňte pole Email";
            } else {
                $this->tplData['email']['value'] = $this->test_input($_POST["email"]);
                if (!filter_var($this->tplData['email']['value'], FILTER_VALIDATE_EMAIL)) {
                    $this->tplData['email']['error'] = "Špatný format emailu";
                }
            }

            if (empty($_POST["heslo"])) {
                $this->tplData['heslo']['error'] = "Musíte zadat heslo";
            } else {
                $this->tplData['heslo']['value'] = $this->test_input($_POST["heslo"]);
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