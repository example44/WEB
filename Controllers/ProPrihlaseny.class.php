<?php


class ProPrihlaseny{
        public function isLoginUzivatel(){
            if(isset($_SESSION['id_uzivatel'])){
                return true;
            }
            else{
                return false;
            }
        }
}
?>