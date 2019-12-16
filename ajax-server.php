<?php
    require_once "settings.inc.php";
    require_once DIRECTORY_CONTROLLERS."/ProPrihlaseny.class.php";
    $userMan = new ProPrihlaseny();
    if(isset($_GET['email'])){
        $users = $userMan->getAllusers();
        $text = "";
        for($i = 0; $i < count($users); $i++){
            if($users[$i]['email'] == $_GET['email']){
                $text = "Už existuje";
                break;
            }
        }
        echo $text;
    }
    if(isset($_GET['username'])){
        $users = $userMan->getAllusers();
        $text = "";
        for($i = 0; $i < count($users); $i++){
            if($users[$i]['username'] == $_GET['username']){
                $text = "Už existuje";
                break;
            }
        }
        echo $text;
    }
    if(isset($_GET['id_recenze'])){
        $users = $userMan->getRecenze($_GET['id_recenze']);
        $text = $users[0];
        echo json_encode($text);
    }


?>
