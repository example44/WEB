<?php


class UvodniStranka implements IController {

    public function __construct(){
        require_once "settings.inc.php";
        require_once DIRECTORY_MODELS."/Database.class.php";
        $database = new Database();
    }
    public function registruj(){

    }

    private function kontroluj(){

    }

    private function addUser(){

    }

    private function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     * Zajisti vypsani prislusne stranky.
     *
     */
    public function show(){
        $tplData = [];
        $tplData['title'] = "uvodni stranka";


        // vratim sablonu naplnenou daty
        return $tplData;
    }
}

?>