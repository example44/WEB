<?php

class EditPosud implements IController {
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
            $GLOBALS['alert'] = "OK: Uživatel byl odhlášen.";
            header("Location: index.php?page=uvodni");
        }

        $this->tplData['obsah'] = $this->userMan->getSeznamRecenzenta();
        if (isset($_POST['action']) && $_POST['action'] == 'odeslat'){
            for($i = 0; $i < count($this->tplData['obsah']); $i++) {
                if ($this->tplData['obsah'][$i]['id_RECENZE'] == $_POST['recenze']) {
                    $this->tplData['error'] = '';
                    $this->tplData['povolit'] = true;
                    break;
                } else {
                    $this->tplData['error'] = "Špatný recept";
                    $this->tplData['povolit'] = false;
                }
            }
            if($this->tplData['povolit']) {
                $this->kontolRegistrace();
                $this->userMan->editRecenz($this->tplData['obsah'][$i]['id_RECENZE'],
                                            $this->tplData['originalita']['value'],
                                            $this->tplData['tema']['value'],
                                            $this->tplData['technicka_kvalita']['value'],
                                            $this->tplData['jazykova_kvalita']['value'],
                                            $this->tplData['doporuceni']['value'],
                                            $this->tplData['poznamky']['value']);
                $GLOBALS['alert'] = "OK: Recept byl ohodnocen.";
            } else {
                $GLOBALS['alert'] = "CHYBA: Recept nebyl ohodnocen.";
            }
        }
        return $this->tplData;
    }

    private function kontolRegistrace(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['originalita'])) {
                $this->tplData['originalita']['error'] = "Vypňte pole recenze";
                $this->tplData['povolit'] = false;
            } else {
                $this->tplData['originalita']['value'] = $this->test_input($_POST['originalita']);
                if (is_numeric($this->tplData['originalita']['value'])&&is_int($this->tplData['originalita']['value']) && $this->tplData['originalita']['value'] > 0 && $this->tplData['originalita']['value'] < 6) {
                    $this->tplData['originalita']['error'] = "Špatná hodnota";
                    $this->tplData['povolit'] = false;
                }
            }

            if (empty($_POST['tema'])) {
                $this->tplData['tema']['error'] = "Vypňte pole téma";
                $this->tplData['povolit'] = false;
            } else {
                $this->tplData['tema']['value'] = $this->test_input($_POST["tema"]);
                if (is_numeric($this->tplData['tema']['value'])&&is_int($this->tplData['tema']['value']) && $this->tplData['tema']['value'] > 0 && $this->tplData['tema']['value'] < 6) {
                    $this->tplData['tema']['error'] = "Špatná hodnota";
                    $this->tplData['povolit'] = false;
                }
            }

            if (empty($_POST['technicka_kvalita'])) {
                $this->tplData['technicka_kvalita']['error'] = "Vypňte pole technická kvalita";
                $this->tplData['povolit'] = false;
            } else {
                $this->tplData['technicka_kvalita']['value'] = $this->test_input($_POST["technicka_kvalita"]);
                if (is_numeric($this->tplData['technicka_kvalita']['value'])&&is_int($this->tplData['technicka_kvalita']['value']) && $this->tplData['technicka_kvalita']['value'] > 0 && $this->tplData['technicka_kvalita']['value'] < 6) {
                    $this->tplData['technicka_kvalita']['error'] = "Špatná hodnota";
                    $this->tplData['povolit'] = false;
                }
            }
            if (empty($_POST['jazykova_kvalita'])) {
                $this->tplData['jazykova_kvalita']['error'] = "Vypňte pole jazyková kvalita";
                $this->tplData['povolit'] = false;
            } else {
                $this->tplData['jazykova_kvalita']['value'] = $this->test_input($_POST["jazykova_kvalita"]);
                if (is_numeric($this->tplData['jazykova_kvalita']['value'])&&is_int($this->tplData['jazykova_kvalita']['value']) && $this->tplData['jazykova_kvalita']['value'] > 0 && $this->tplData['jazykova_kvalita']['value'] < 6) {
                    $this->tplData['jazykova_kvalita']['error'] = "Špatná hodnota";
                    $this->tplData['povolit'] = false;
                }
            }
            if (empty($_POST['doporuceni'])) {
                $this->tplData['tema']['error'] = "Vypňte pole doporučení";
                $this->tplData['povolit'] = false;
            } else {
                $this->tplData['doporuceni']['value'] = $this->test_input($_POST["doporuceni"]);
                if (is_numeric($this->tplData['doporuceni']['value'])&&is_int($this->tplData['doporuceni']['value']) && $this->tplData['doporuceni']['value'] > 0 && $this->tplData['doporuceni']['value'] < 6) {
                    $this->tplData['doporuceni']['error'] = "Špatná hodnota";
                    $this->tplData['povolit'] = false;
                }
            }

            $this->tplData['poznamky']['value'] = $this->test_input($_POST["poznamky"]);
        }
    }

    private function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}