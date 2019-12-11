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
                               "povolit_create" => true
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

        if (isset($_POST['action']) && $_POST['action'] == 'create_recept'){
            $this->kontolNewRecept();
            if ($this->tplData['povolit_create']) {
                $this->userMan->addRecept($this->tplData['obsah']['value'], $this->tplData['recept_naz']['value']);
                $this->tplData['alert'] = "OK: Vytvořen nový recept.";
                echo "OK: Vytvořen nový recept.";
                header("Location: index.php?page=recepAutor");
            } else {
                $this->tplData['alert'] = "ERROR: Nezdařilo vytvořit recept.";
                echo "ERROR: Nezdařilo vytvořit recept.";
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
                //mozna kontrola symbolu
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

}