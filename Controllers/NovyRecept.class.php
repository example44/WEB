<?php


class NovyRecept implements IController{
    private $userMan;
    private $tplData;

    public function __construct(){
        require_once "settings.inc.php";
        require_once DIRECTORY_CONTROLLERS."/ProPrihlaseny.class.php";
        $this->userMan = new ProPrihlaseny();
        $this->tplData = array("obsah" => array( "value" => '', "error" => ''),
                               "alert" => "",
                               "recept_naz" => array( "value" => '', "error" => ''),
                               "soubor" => array("value" => '', 'error' => '', 'cesta' => ''),
                               "povolit_create" => true
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

        if (isset($_POST['action']) && $_POST['action'] == 'create_recept'){
            $this->kontolNewRecept();
            $this->uploadFile();
            if ($this->tplData['povolit_create']) {
                $this->userMan->addRecept($this->tplData['obsah']['value'], $this->tplData['recept_naz']['value']);
                $GLOBALS['alert'] = "OK: Vytvořen nový recept.";
                $this->userMan->addSoubor($this->tplData['recept_naz']['value'], $this->tplData['soubor']['value']);
            } else {
                $GLOBALS['alert'] = "CHYBA: Nezdařilo vytvořit recept.";
            }

        }

        return $this->tplData;
    }

    private function kontolNewRecept(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['recept_naz'])) {
                $this->tplData['recept_naz']['error'] = "Nezadal jste název";
                $this->tplData['povolit_create'] = false;
            } else {
                $this->tplData['recept_naz']['value'] = $this->test_input($_POST['recept_naz']);
            }
            if (empty($_POST['recept_ob'])) {
                $this->tplData['obsah']['error'] = "Musíte napsat popis receptu";
                $this->tplData['povolit_create'] = false;
            } else {
                $this->tplData['obsah']['value'] = $this->test_input($_POST['recept_ob']);
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
        $this->tplData['povolit_create'] = $uploadOk;
        return $uploadOk;
    }

}