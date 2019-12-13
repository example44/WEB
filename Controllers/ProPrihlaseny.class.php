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
     * @param string $email
     * @param string $heslo
     * @return bool
     */
    public function userLogin(string $email, string $heslo){
        $user = $this->db->getUserAutoriz("$email", "$heslo");
        if(count($user)){
            $_SESSION[$this->userSessionKey] = $user[0]['id_UZIVATEL'];
            return true;
        } else {
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
            $userId = $_SESSION[$this->userSessionKey];
            if($userId == null) {
                echo "SEVER ERROR: Data přihlášeného uživatele nebyla nalezena, a proto byl uživatel odhlášen.";
                $this->userLogout();
                return null;
            } else {
                $userData = $this->db->selectFromTable(TABLE_UZIVATEL, "id_UZIVATEL=$userId");
                if(empty($userData)){
                    echo "ERROR: Data přihlášeného uživatele se nenachází v databázi (mohl být smazán), a proto byl uživatel odhlášen.";
                    $this->userLogout();
                    return null;
                } else {
                    return $userData[0];
                }
            }
    }

    /**
     * @return mixed
     */
    public function getAllRightsForRegist(){
        $users = $this->db->selectFromTable(TABLE_ROLE, "id_ROLE > 1");
        return $users;
    }

    /**
     * @param string $email
     * @param string $heslo
     * @param string $name
     * @param int $role
     */
    public function addUser(string $email, string $heslo, string  $name, int $role){
        $this->db->addNewUser($email, $heslo, $name, $role);
    }

    /**
     * @param $id_prispevek
     * @return bool
     */
    public function smazatPrispevek($id_prispevek){
        $this->db->deletePrispevek($id_prispevek);
    }

    /**
     * @return array
     */
    public function getAutorRecept(){
        return $this->db->getAutorRecepts($_SESSION[$this->userSessionKey]);
    }

    /**
     * @return array
     */
    public function getVerejRecepty(){
        return $this->db->getVerejRecept();
    }

    /**
     * @param string $obsah
     * @param string $nazev
     */
    public function addRecept(string $obsah, string $nazev){
        $this->db->addPrispevek("$obsah", "$nazev", $_SESSION[$this->userSessionKey]);
    }

    /**
     * @param string $nazev_pris
     * @param string $id_prispevek
     */
    public function addSoubor(string $nazev_pris, string $nazev_dok){
        $id_prispevek = $this->getReceptProSoubor($nazev_pris)[0]['id_PRISPEVEK'];
        $this->db->addSoubor("$nazev_dok", "$id_prispevek");
    }

    /**
     * @param string $nazev
     * @return array
     */
    public function getReceptProSoubor(string $nazev){
        return $this->db->selectFromTable(TABLE_PRISPEVEK, "nazev='$nazev'");
    }

    /**
     * @return array
     */
    public function getVseRecepty(){
        return $this->db->getVseRecepty();
    }




    public function editRecenz(string $originalita, string $tema, string $tech_kval, string $jazyk_kval, string $doporuc, string $poznamky, string $id_prispevku){
        $this->db->editPosudku($originalita, $tema, $tech_kval,  $jazyk_kval, $doporuc,  $poznamky,  $id_prispevku);
    }

    public function getRecenzenty(){
        return $this->db->getRecenzenty();
    }

    public function zverejnit($id_prispevek){
        return $this->db->zverejnit($id_prispevek);
    }

    public function vynulovatRecenze($id_prispevek, $id_recenze){
        $res1 = $this->db->deleteRecenze($id_recenze);
        $this->db->addRecenze($id_prispevek);
        return $res1;
    }

    public function getRecenzeKReceptu($id_prispevek){
        return $this->db->getRecenzeKReceptu($id_prispevek);
    }

    public function getSeznamRecenzenta(){
        return $this->db->getSeznamKPosouzeni($_SESSION[$this->userSessionKey]);
    }

    public function pridatRecenzenta($id_uzivatel, $id_recenze){
        $this->db->priradRecenzenta($id_uzivatel, $id_recenze);
    }

    public function getUzivatel($id_uzivatel = 0){
        if($id_uzivatel) {
            return $this->db->selectFromTable(TABLE_UZIVATEL, "id_UZIVATEL=$id_uzivatel");
        }else{
            return "Nezadan";
        }
    }
}
?>