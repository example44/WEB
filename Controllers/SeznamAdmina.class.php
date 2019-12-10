<?php


class SeznamAdmina implements IController {
    private $userMan;
    private $tplData;

    public function __construct(){
        require_once "settings.inc.php";
        require_once DIRECTORY_CONTROLLERS."/ProPrihlaseny.class.php";
        $this->userMan = new ProPrihlaseny();
        $this->tplData = array("obsah" => "",
                               "alert" => ""
        );
    }

    public function show(){
        if($this->userMan->isUserLogged()){
            $this->tplData['uzivatel']['username'] = $this->userMan->getLoggedUserData()['username'];
            $this->tplData['uzivatel']['role'] = $this->userMan->getLoggedUserData()['ROLE_id_ROLE'];
        }
        else{
            $this->tplData['uzivatel']['role'] = 0;
        }
        $this->tplData['obsah'] = $this->userMan->getReceptyRecenze();

        return $this->tplData;
    }
}