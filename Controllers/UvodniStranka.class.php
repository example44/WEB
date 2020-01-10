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
                 Nullam sit amet odio sed.
                 Nam sed tellus id magna elementum tincidunt. Integer lacinia. Fusce nibh. Vestibulum erat nulla, ullamcorper nec, rutrum non, nonummy ac, erat. Nunc dapibus tortor vel mi dapibus sollicitudin. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Phasellus faucibus molestie nisl. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam posuere lacus quis dolor. In laoreet, magna id viverra tincidunt, sem odio bibendum justo, vel imperdiet sapien wisi sed libero. Etiam sapien elit, consequat eget, tristique non, venenatis quis, ante. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. Etiam posuere lacus quis dolor. Fusce wisi.

                Duis ante orci, molestie vitae vehicula venenatis, tincidunt ac pede.
                 Pellentesque sapien. Aenean fermentum risus id tortor. Duis pulvinar.
                  Nullam justo enim, consectetuer nec, ullamcorper ac, vestibulum in, elit.
                   Aliquam ornare wisi eu metus. Fusce aliquam vestibulum ipsum. Etiam ligula pede, sagittis quis,
                    interdum ultricies, scelerisque eu. In laoreet, magna id viverra tincidunt, sem odio bibendum justo,
                     vel imperdiet sapien wisi sed libero. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit,
                      sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Aliquam in lorem sit amet leo accumsan lacinia.
                       Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque sapien. Proin pede metus,
                        vulputate nec, fermentum fringilla, vehicula vitae, justo. Vivamus ac leo pretium faucibus. Fusce aliquam vestibulum ipsum. Maecenas ipsum velit,
                         consectetuer eu lobortis ut, dictum at dui. Integer in sapien. Etiam commodo dui eget wisi. Curabitur bibendum justo non orci.",
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