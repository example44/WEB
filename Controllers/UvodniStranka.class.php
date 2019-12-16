<?php


class UvodniStranka implements IController {
    private $userMan;
    private $tplData;

    public function __construct(){
        require_once "settings.inc.php";
        require_once DIRECTORY_CONTROLLERS."/ProPrihlaseny.class.php";
        $this->userMan = new ProPrihlaseny();
        $this->tplData = array("obsah" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.
         Sed feugiat elit lacinia nisi vehicula semper.
          Sed vulputate ultrices convallis. Cras a mauris odio.
           Etiam eu eros ac quam sodales tristique. Etiam neque erat, hendrerit ut feugiat sit amet, rhoncus nec urna.
            Duis luctus justo vestibulum, fermentum orci non, consectetur urna. Praesent lacus purus, suscipit a dolor sed, placerat maximus purus.
             Aliquam egestas eleifend orci quis tempor.
              Nam scelerisque orci ut libero hendrerit dignissim.
               Nam quam dolor, tempor ac metus id, tincidunt pharetra lacus.
                Quisque varius consequat lacus sed imperdiet. Integer faucibus quam eget maximus lacinia.
                 Nullam sit amet odio sed.",
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
            $GLOBALS['alert'] = "OK: Uživatel byl odhlášen.";
            header("Location: index.php?page=uvodni");
        }

        return $this->tplData;
    }
}

?>