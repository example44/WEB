<?php

// spustim aplikaci
$app = new ApplicationStart();
$app->appStart();

/**
 * Vstupni bod webove aplikace.
 */
class ApplicationStart {

    /**
     * Inicializace webove aplikace.
     */
    public function __construct(){
        // nactu nastaveni
        require_once("settings.inc.php");
        // nactu rozhrani kontroleru
        require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");
    }

    /**
     * Spusteni webove aplikace.
     */
    public function appStart(){
        if(isset($_GET['page']) && array_key_exists($_GET['page'], WEB_PAGES)){
            $pageKey = $_GET['page'];
        }else{
            $pageKey = DEFAULT_WEB_PAGE_KEY;
        }

        $pageInfo = WEB_PAGES[$pageKey];

        require_once(DIRECTORY_CONTROLLERS."/".$pageInfo['file_name']);
        /** @var IController $controller */
        $controller = new $pageInfo['class_name'];




        global $tplData;
        $tplData = $controller->show();

        // pripojim sablonu, cimz ji i vykonam
        require(DIRECTORY_VIEWS ."/".$pageInfo['template_name']);

    }
}

?>
