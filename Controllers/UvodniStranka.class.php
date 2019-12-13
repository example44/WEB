<?php


class UvodniStranka implements IController {
    private $userMan;
    private $tplData;

    public function __construct(){
        require_once "settings.inc.php";
        require_once DIRECTORY_CONTROLLERS."/ProPrihlaseny.class.php";
        $this->userMan = new ProPrihlaseny();
        $this->tplData = array("obsah" => "",
                               "alert" => "",
                               "uzivatel" => array()
        );
    }

    public function show(){
        if($this->userMan->isUserLogged()){
            $this->tplData['uzivatel']['username'] = $this->userMan->getLoggedUserData()['username'];
            $this->tplData['uzivatel']['role'] = $this->userMan->getLoggedUserData()['id_ROLE'];
        }
        else{
            $this->tplData['uzivatel']['role'] = 0;
        }
        if (isset($_POST['action']) && $_POST['action'] == 'odhlaseni') {
            $this->userMan->userLogout();
            $this->tplData['alert'] = "OK: Uživatel byl odhlášen.";
            echo "OK: Uživatel byl odhlášen.";
            header("Location: index.php?page=uvodni");
        }

        return $this->tplData;
    }
}

?>