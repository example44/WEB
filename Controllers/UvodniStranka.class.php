<?php


class UvodniStranka implements IController {
    private $userMan;

    public function __construct(){
        require_once "settings.inc.php";
        require_once DIRECTORY_CONTROLLERS."/ProPrihlaseny.class.php";
        $this->userMan = new ProPrihlaseny();
    }

    public function show(){
        if (isset($_POST['action']) && $_POST['action'] == 'odhlaseni') {
            // odhlasim uzivatele
            $this->userMan->userLogout();
            echo "OK: Uživatel byl odhlášen.";
        }

        $tplData = [0];
        return $tplData;
    }
}

?>