<?php


class ProPrihlaseny{
    private $session;
    private $userSessionKey = "current_user_id";
    private $db;

    public function __construct(){
        require_once "ConfSession.class.php";
        $this->session = new ConfSession();
        require_once DIRECTORY_MODELS."/Database.class.php";
        $this->db = new Database();
    }

    /**
     * Overi, zda muse byt uzivatel prihlasen a pripadne ho prihlasi.
     *
     * @param string $login     Login uzivatele.
     * @param string $heslo     Heslo uzivatele.
     * @return bool             Byl prihlasen?
     */
    public function userLogin(string $email, string $heslo){
        // ziskam uzivatele z DB - primo overuju login i heslo
        $where = "email='$email' AND heslo='$heslo'";
        $user = $this->db->selectFromTable(TABLE_UZIVATEL, $where);
        // ziskal jsem uzivatele
        if(count($user)){
            // ziskal - ulozim ho do session
            $_SESSION[$this->userSessionKey] = $user[0]['id_UZIVATEL']; // beru prvniho nalezeneho a ukladam jen jeho ID
            return true;
        } else {
            // neziskal jsem uzivatele
            return false;
        }
    }

    /**
     * Odhlasi soucasneho uzivatele.
     */
    public function userLogout(){
        unset($_SESSION[$this->userSessionKey]);
    }

    /**
     * Test, zda je nyni uzivatel prihlasen.
     *
     * @return bool     Je prihlasen?
     */
    public function isUserLogged(){
        return isset($_SESSION[$this->userSessionKey]);
    }

    /**
     * Pokud je uzivatel prihlasen, tak vrati jeho data,
     * ale pokud nebyla v session nalezena, tak vypisu chybu.
     *
     * @return mixed|null   Data uzivatele nebo null.
     */
    public function getLoggedUserData(){
        if($this->isUserLogged()){
            // ziskam data uzivatele ze session
            $userId = $_SESSION[$this->userSessionKey];
            // pokud nemam data uzivatele, tak vypisu chybu a vynutim odhlaseni uzivatele
            if($userId == null) {
                // nemam data uzivatele ze session - vypisu jen chybu, uzivatele odhlasim a vratim null
                echo "SEVER ERROR: Data přihlášeného uživatele nebyla nalezena, a proto byl uživatel odhlášen.";
                $this->userLogout();
                // vracim null
                return null;
            } else {
                // nactu data uzivatele z databaze
                $userData = $this->db->selectFromTable(TABLE_UZIVATEL, "id_UZIVATEL=$userId");
                // mam data uzivatele?
                if(empty($userData)){
                    // nemam - vypisu jen chybu, uzivatele odhlasim a vratim null
                    echo "ERROR: Data přihlášeného uživatele se nenachází v databázi (mohl být smazán), a proto byl uživatel odhlášen.";
                    $this->userLogout();
                    return null;
                } else {
                    // protoze DB vraci pole uzivatelu, tak vyjmu jeho prvni polozku a vratim ziskana data uzivatele
                    return $userData[0];
                }
            }
        } else {
            // uzivatel neni prihlasen - vracim null
            return null;
        }
    }

    public function addUser(string $email, string $heslo, string  $name, int $role){
        return $this->db->addNewUser($email, $heslo, $name, $role);
    }

    public function getRoleProRegist(){
        return $this->db->getAllRightsForRegist();
    }

    public function getVseRecepty(){
        return $this->db->getAllRecepts();
    }

    public function getAutorRecept(){
        return $this->db->getAutorRecepts($_SESSION[$this->userSessionKey]);
    }

    public function smazatPrispevek($id_prispevek){
        $this->db->deletePrispevek($id_prispevek);
    }

    public function addRecept(){
        $this->db->addPrispevek();
    }

    public function editRecenz(string $originalita, string $tema, string $tech_kval, string $jazyk_kval, string $doporuc, string $poznamky, string $id_prispevku){
        $this->db->editPosudku($originalita, $tema, $tech_kval,  $jazyk_kval, $doporuc,  $poznamky,  $id_prispevku);
    }

    public function getRecenzenty(){
        return $this->db->getRecenzenty();
    }


    public function getReceptyRecenze(){
        return $this->db->getReceptyRecenze();
    }

    public function getSeznamRecenzenta(){
        $this->db->getSeznamKPosouzeni($_SESSION[$this->userSessionKey]);
    }

    public function pridatRecenzenta($id_uzivatel, $id_recenze){
        $this->db->priradRecenzenta($id_uzivatel, $id_recenze);
    }
}
?>