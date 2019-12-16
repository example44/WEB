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
//        var_dump($tplData);
        $tplData['menu'] = [];
        foreach (WEB_PAGES as $key => $p){
            if(isset(WEB_PAGES[$key]['role']) && in_array($tplData['uzivatel']['role'], WEB_PAGES[$key]['role'])){
                $tplData['menu'][$key] = 0;
                $tplData['menu'][$key]= WEB_PAGES[$key];
            }
        }
        if(isset($pageInfo['role']) && in_array( $tplData['uzivatel']['role'], $pageInfo['role'])){
            require(DIRECTORY_VIEWS ."/".$pageInfo['template_name']);
        }
        else{
            require_once(DIRECTORY_VIEWS ."/nemate_pravo.php");
        }


    }
}

?>
