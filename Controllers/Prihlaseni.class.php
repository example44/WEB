<?php


class Prihlaseni{

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
}