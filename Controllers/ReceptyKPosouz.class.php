<?php


class ReceptyKPosouz implements IController{
    public function __construct(){
        require_once "settings.inc.php";
        require_once DIRECTORY_MODELS."/Database.class.php";
        $database = new Database();
    }

    public function show(){
        $tplData = [];
        $tplData['title'] = "Seznam receptů k posouzení";



        return $tplData;
    }
}