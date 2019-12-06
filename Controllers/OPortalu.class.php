<?php


class OPortalu implements IController {
    private $userMan;

    public function __construct(){
        require_once "settings.inc.php";
        require_once DIRECTORY_CONTROLLERS."/ProPrihlaseny.class.php";
        $this->userMan = new ProPrihlaseny();
    }

    public function show(){



        $tplData = [0];
        return $tplData;
    }
}

?>