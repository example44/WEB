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
        if (isset($_POST['action'])) {
            // prihlaseni
            if ($_POST['action'] == 'vstup' && isset($_POST['email']) && isset($_POST['heslo'])) {
                // pokusim se prihlasit uzivatele
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
        $tplData = [0];
        return $tplData;
    }
}
?>