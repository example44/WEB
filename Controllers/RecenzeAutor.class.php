<?php


class RecenzeAutor implements IController {
    private $userMan;
    private $tplData;

    public function __construct(){
        require_once "settings.inc.php";
        require_once DIRECTORY_CONTROLLERS."/ProPrihlaseny.class.php";
        $this->userMan = new ProPrihlaseny();
        $this->tplData = array("obsah" => "",
                               "alert" => "",
                               "povolit_smazani" => true
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
            $GLOBALS['alert'] = "OK: Uživatel byl odhlášen.";
            header("Location: index.php?page=uvodni");
        }

        $this->tplData['obsah'] = $this->userMan->getAutorRecenze();
        if (isset($_POST['action']) && $_POST['action'] == 'delete'){
            for($i = 0; $i < count($this->tplData['obsah']); $i++) {
                if ($this->tplData['obsah'][$i]['id_PRISPEVEK'] == $_POST['recenze_del']) {
                    $this->tplData['error'] = '';
                    $this->tplData['povolit_smazani'] = true;
                    break;
                } else {
                    $this->tplData['error'] = "Špatná recenze";
                    $this->tplData['povolit_smazani'] = false;
                }
            }
        if($this->tplData['povolit_smazani']) {
             $this->userMan->smazatPrispevek($_POST['recenze_del']);
             header("Location: index.php?page=recepAutor");
            $GLOBALS['alert'] = "OK: Recenze bylá smazana.";

             } else {
            $GLOBALS['alert'] = "CHYBA: Recenze nebyla smazana.";
             }
        }
        for($i = 0; $i < count($this->tplData['obsah']); $i++) {
            $user = $this->userMan->getUzivatel($this->tplData['obsah'][$i]['id_UZIVATEL']);
            $soubor = $this->userMan->getSouborRecenze($this->tplData['obsah'][$i]['id_PRISPEVEK']);
            if (count($soubor)) {
                $this->tplData['obsah'][$i]['nazev_souboru'] = $soubor;
            } else {
                $this->tplData['obsah'][$i]['nazev_souboru'][0]['nazev'] = "Žadný soubor";
            }
        }


        return $this->tplData;
    }
}