<?php
    require_once "settings.inc.php";
    require_once DIRECTORY_CONTROLLERS."/ProPrihlaseny.class.php";
    $userMan = new ProPrihlaseny();
    if(isset($_GET['email'])){
        $roles = $userMan->getAllusers();
        $text = "";
        for($i = 0; $i < count($roles); $i++){
            if($roles[$i]['email'] == $_GET['email']){
                $text = "Už existuje";
                break;
            }
        }
        echo $text;
    }
    if(isset($_GET['username'])){
        $roles = $userMan->getAllusers();
        $text = "";
        for($i = 0; $i < count($roles); $i++){
            if($roles[$i]['username'] == $_GET['username']){
                $text = "Už existuje";
                break;
            }
        }
        echo $text;
    }
    if(isset($_GET['id_recenze'])){
        $roles = $userMan->getRecenze($_GET['id_recenze']);
        $text = $roles[0];
        echo json_encode($text);
    }

    if(isset($_GET['id_role'])){
    $roles = $userMan->getAllRole();
    $text = "";
    for($i = 0; $i < count($roles); $i++){
        if($roles[$i]['id_ROLE'] == $_GET['id_role']){
            $text = $roles[$i]['nazev'];
            break;
        }
    }
    echo $text;
    }
    if(isset($_GET['id_recept'])){
        $recept = $userMan->getRecept($_GET['id_recept']);
        $fileName = $userMan->getSouborRecepta($_GET['id_recept']);
        $fileName = $fileName[0][1];
        $text = $recept[0];
        $text[5]=$fileName;
        echo json_encode($text);
    }

?>
