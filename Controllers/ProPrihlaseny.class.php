<?php


class ProPrihlaseny{
    private $session;

    public function __construct(){
        $this->session = new ConfSession();
    }

    public function isLoginUzivatel(){
            if($this->session->isSessionSet("current_user_id")){
                return true;
            }
            else{
                return false;
            }
        }
}
?>