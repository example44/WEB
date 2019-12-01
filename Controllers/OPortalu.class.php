<?php


class OPortalu implements IController {

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
     * @param string $pageTitle Nazev stanky.
     * @return string               HTML prislusne stranky.
     */
    public function show(string $pageTitle): string{
        // zapnu output buffer pro odchyceni vypisu sablony
        ob_start();
        // pripojim sablonu, cimz ji i vykonam
        require(DIRECTORY_VIEWS ."/o_portalu.php");
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
}

?>