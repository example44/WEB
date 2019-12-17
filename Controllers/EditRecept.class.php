<?php


class EditRecept implements IController {
    private $userMan;
    private $tplData;

    public function __construct(){
        require_once "settings.inc.php";
        require_once DIRECTORY_CONTROLLERS."/ProPrihlaseny.class.php";
        $this->userMan = new ProPrihlaseny();
        $this->tplData = array("obsah" => "",
                                "alert" => "",
                                "nazev" => array("value" => "",
                                                 "error" => ""),
                                "popis" => array("value" => "",
                                                 "error" => ""),
                                "soubor" => array("value" => "",
                                                 "error" => "")
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

        $this->tplData['obsah'] = $this->userMan->getAutorRecept();
        if (isset($_POST['action']) && $_POST['action'] == 'odeslat'){
            for($i = 0; $i < count($this->tplData['obsah']); $i++) {
                if ($this->tplData['obsah'][$i]['id_PRISPEVEK'] == $_POST['recept']) {
                    $this->tplData['error'] = '';
                    $this->tplData['povolit'] = true;
                    break;
                } else {
                    $this->tplData['error'] = "Špatný recept";
                    $this->tplData['povolit'] = false;
                }
            }
            $this->kontolEditRecept();
            $this->uploadFile();
            if ($this->tplData['povolit']) {
                $this->userMan->smazatPrispevek($this->tplData['obsah'][$i]['id_PRISPEVEK']);
                $this->userMan->addRecept($this->tplData['popis']['value'], $this->tplData['nazev']['value']);
                $GLOBALS['alert'] = "OK: Recept byl editovan.";
                $this->userMan->addSoubor($this->tplData['nazev']['value'], $this->tplData['soubor']['value']);
            } else {
                $GLOBALS['alert'] = "CHYBA: Recept nebyl editovan.";
            }

        }
        return $this->tplData;
    }

    private function kontolEditRecept(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['nazev'])) {
                $this->tplData['nazev']['error'] = "Vypňte pole nazev";
                $this->tplData['povolit'] = false;
            } else {
                $this->tplData['nazev']['value'] = $this->test_input($_POST['nazev']);

            }

            if (empty($_POST['popis'])) {
                $this->tplData['popis']['error'] = "Vypňte pole popis receptu";
                $this->tplData['povolit'] = false;
            } else {
                $this->tplData['popis']['value'] = $this->test_input($_POST['popis']);
            }
        }
    }

    private function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function uploadFile(){
        $target_dir = "soubory/";
        $target_file = $target_dir . basename($_FILES["soubor"]["name"]);
        $this->tplData['soubor']['cesta'] = $target_file;
        $this->tplData['soubor']['value'] = basename($_FILES["soubor"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(isset($_POST["action"])) {
            $check = filesize($_FILES["soubor"]["tmp_name"]);
            if($check != null) {
                $GLOBALS['alert'] = "Soubor je dokumentem ";
                $uploadOk = 1;
            } else {
                $GLOBALS['alert'] = "Soubor není dokumentem.";
                $uploadOk = 0;
            }
        }

        if (file_exists($target_file)) {
            $GLOBALS['alert'] = "Soubor už existuje.";
            $uploadOk = 0;
        }

        if ($_FILES["soubor"]["size"] > 10485760) {
            $GLOBALS['alert'] = "Soubor je přilíš velký.";
            $uploadOk = 0;
        }

        if($fileType != "pdf") {
            $GLOBALS['alert'] = "Povolené jsou soubory PDF.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $GLOBALS['alert'] = "Soubor nebyl nahrán.";
        } else {
            if (move_uploaded_file($_FILES["soubor"]["tmp_name"], $target_file)) {
                $GLOBALS['alert'] = "Soubor ". basename( $_FILES["soubor"]["name"]). " byl nahrán.";
            } else {
                $GLOBALS['alert'] = "Chyba při nahraní souboru.";
            }
        }
        $this->tplData['povolit'] = $uploadOk;
        return $uploadOk;
    }
}