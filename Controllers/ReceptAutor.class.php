<?php


class ReceptAutor implements IController {
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
        if (isset($_POST['action']) && $_POST['action'] == 'delete'){
            $ok = $this->userMan->smazatPrispevek($_POST['recept_del']);
            if($ok){
                $this->tplData['alert'] = "OK: Recept byl smazan.";
                echo "OK: Recept byl smazan.";
            } else {
                $this->tplData['alert'] = "ERROR: Recept nebyl smazan.";
                echo "ERROR: Recept nebyl smazan.";
            }
        }
        $this->tplData['obsah'] = $this->userMan->getAutorRecept();


        return $this->tplData;
    }
}