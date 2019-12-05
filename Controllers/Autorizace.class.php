<?php


class Autorizace implements IController
{
    private $database;
    private $userSessionKey = "current_user_id";

    public function __construct()
    {
        require_once "settings.inc.php";
        require_once DIRECTORY_MODELS . "/Database.class.php";
        $this->database = new Database();
    }

    public function show(){
        if (isset($_POST['action']) && $_POST['action'] == "vstup") {
            if (isset($_POST['email']) && $_POST['heslo']) {
                $email = $_POST['email'];
                $heslo = $_POST['heslo'];
                $where = "email='$email' AND heslo='$heslo'";
                $user = $this->database->selectFromTable(TABLE_UZIVATEL, $where);

                if (count($user)) {
                    $_SESSION[$this->userSessionKey] = $user[0]['id_UZIVATEL'];
                    echo "Jste prihlasen ".$user[0]['username'];
                }
            }
            $tplData = [];
            $tplData['title'] = "Autorizace";


            return $tplData;
        }

    }
}
?>