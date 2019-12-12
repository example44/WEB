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
        $this->tplData['obsah'] = $this->userMan->getVseRecepty();
        for($i = 0; $i < count($this->tplData['obsah']); $i++){
            $user = $this->userMan->getUzivatel($this->tplData['obsah'][$i]['UZIVATEL_id_UZIVATEL']);
            $this->tplData['obsah'][$i]['UZIVATEL_id_UZIVATEL'] = $user[0]['username'];
            $this->tplData['obsah'][$i]['recenze'] = $this->userMan->getRecenzeKReceptu($this->tplData['obsah'][$i]['id_PRISPEVEK']);
            for($j = 0; $j < count($this->tplData['obsah'][$i]['recenze']); $j++){
                $user = $this->userMan->getUzivatel($this->tplData['obsah'][$i]['recenze'][$j]['id_UZIVATEL']);
                if($user != "Nezadan") {
                    $this->tplData['obsah'][$i]['recenze'][$j]['id_UZIVATEL'] = $user[0]['username'];
                }else{
                    $this->tplData['obsah'][$i]['recenze'][$j]['id_UZIVATEL'] = $user;
                }
                //var_dump($this->tplData['obsah'][$i]['recenze']);
            }
        }

        if (isset($_POST['action'])){
            if($_POST['action'] == 'delete') {
                $ok = $this->userMan->vynulovatRecenze($_POST['recept'], $_POST['recenze_del']);
                if ($ok) {
                    $this->tplData['alert'] = "OK: Recenze byla smazana.";
                    echo "OK: Recenze byla smazana.";
                    header("Location: index.php?page=seznamAdmina");
                } else {
                    $this->tplData['alert'] = "ERROR: Recenze nebyla smazana.";
                    echo "ERROR: Recenze nebyla smazana.";
                }
            }elseif ($_POST['action'] == 'zverejnit'){
                $ok = $this->userMan->zverejnit($_POST['recept']);
                if ($ok) {
                    $this->tplData['alert'] = "OK: Recept byl zveřejnit.";
                    echo "OK: Recept byl zveřejnit.";
                } else {
                    $this->tplData['alert'] = "ERROR: Recept nebyl zveřejnit.";
                    echo "ERROR: Recept nebyl zveřejnit.";
                }
            }
        }

        return $this->tplData;
    }
}