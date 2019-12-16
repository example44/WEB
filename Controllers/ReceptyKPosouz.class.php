<?php


class ReceptyKPosouz implements IController{
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

        $this->tplData['obsah'] = $this->userMan->getSeznamRecenzenta();

        for($i = 0; $i < count($this->tplData['obsah']); $i++){
            $user = $this->userMan->getUzivatel($this->tplData['obsah'][$i]['id_UZIVATEL']);
            $soubor = $this->userMan->getSouborRecepta($this->tplData['obsah'][$i]['id_PRISPEVEK']);
            if(count($soubor)) {
                $this->tplData['obsah'][$i]['nazev_souboru'] = $soubor;
            }else{
                $this->tplData['obsah'][$i]['nazev_souboru'][0]['nazev'] = "Žadný soubor";
            }
            if($user != "Nezadan") {
                $this->tplData['obsah'][$i]['id_UZIVATEL'] = $user[0]['username'];
            }else{
                $this->tplData['obsah'][$i]['id_UZIVATEL'] = $user;
            }
        }

        return $this->tplData;
    }
}