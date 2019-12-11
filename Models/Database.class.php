<?php
//////////////////////////////////////////////////////////////
////////////// Vlastni trida pro praci s databazi ////////////////
//////////////////////////////////////////////////////////////

/**
 * Vlastni trida spravujici databazi.
 */
require_once "settings.inc.php";
class Database {

    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASS);
    }
//////////////////////  Obecne funkce   ///////////////

    private function executeQuery(string $query){
        //echo $query;
        $stmt = $this->pdo->query($query);
        if($stmt){
            return $stmt;
        }else{
            $error = $this->pdo->errorInfo();
            echo $error[2];
            return null;
        }
    }

    public function selectFromTable(string $tableName, string $where = "", string $orderBy= ""){
        $q = "SELECT * FROM ".$tableName.(($where == "") ? "" : " WHERE ".$where).
            (($orderBy == "") ? "" : " ORDER BY ".$orderBy);
        $result = $this->executeQuery($q);
        if($result == null){
            return [];
        }else{
            return $result->fetchAll();
        }
    }

    public function insertIntoTable(string $tableName, string $insertStatement, string $values){
        $q = "INSERT INTO $tableName($insertStatement)".
            " VALUES ($values)";
        $result = $this->executeQuery($q);
        if($result == null){
            return false;
        }else {
            return true;
        }
    }

    public function updateInTable(string $tableName, string $updateStatementWithValues, string $whereStatement):bool {
        // slozim dotaz
        $q = "UPDATE $tableName SET $updateStatementWithValues WHERE $whereStatement";
        // provedu ho a vratim vysledek
        $obj = $this->executeQuery($q);
        if($obj == null){
            return false;
        } else {
            return true;
        }
    }

    public function deleteFromTable(string $tableName, string $whereStatement){
        // slozim dotaz
        $q = "DELETE FROM $tableName WHERE $whereStatement";
        // provedu ho a vratim vysledek
        $obj = $this->executeQuery($q);
        if($obj == null){
            return false;
        } else {
            return true;
        }
    }
/////////////////// KONEC: Obecne funkce ///////////////////

/////////////////// Specificke funkce /////////////////

    public function getAllUsers(){
        return $this->selectFromTable( TABLE_UZIVATEL);
    }



    public function addNewUser(string $email, string $heslo, string  $name, int $role ){
        // sloupce
        $columns = "email, heslo, username, role_id_role";
        // hodnoty
        $values = "'$email', '$heslo', '$name', '$role'";
        return $this->insertIntoTable(TABLE_UZIVATEL, $columns, $values);
    }

    public function getAllRightsForRegist(){
        $users = $this->selectFromTable(TABLE_PRAVO, "vah < 100");
        return $users;
    }

    public function getAllRecepts(){
        $list_receptu = $this->selectFromTable(TABLE_PRISPEVEK, "rozhodnuti = 1");
        return $list_receptu;
    }

    public function getAutorRecepts(int $id_autora){
        $recepty_autora = $this->selectFromTable(TABLE_PRISPEVEK, "UZIVATEL_id_UZIVATEL = $id_autora");
        return $recepty_autora;
    }

    public function deletePrispevek(int $id_prispevku){
        $this->deleteRecenze($id_prispevku);
        return $this->deleteFromTable(TABLE_PRISPEVEK, "id_PRISPEVEK=$id_prispevku");
    }

    public function deleteRecenze(int $id_prispevku){
        $this->deleteFromTable(TABLE_RECENZE, "PRISPEVEK_id_PRISPEVEK=$id_prispevku");
    }

    public function addPrispevek(string $obsah, string $nazev, int $id_uzivatele){
        // sloupce
        $columns = "obsah, nazev, UZIVATEL_id_UZIVATEL";
        // hodnoty
        $values = "'$obsah', '$nazev', '$id_uzivatele'";
        $podarilo = $this->insertIntoTable(TABLE_PRISPEVEK, $columns, $values);
        if($podarilo){
            $prispevek = $this->selectFromTable(TABLE_PRISPEVEK, "nazev='$nazev'");
            var_dump($prispevek);
            $this->addRecenze($prispevek[0]['id_PRISPEVEK']);
            $this->addRecenze($prispevek[0]['id_PRISPEVEK']);
            $this->addRecenze($prispevek[0]['id_PRISPEVEK']);
        }
        return $podarilo;
    }


    public function getSeznamKPosouzeni($id_uzivatele){
        $k_posouzeni = $this->selectFromTable( TABLE_UZIVATEL." u, ".TABLE_RECENZE." r, ".TABLE_PRISPEVEK." p", "u.id_UZIVATEL=r.id_UZIVATEL AND r.PRISPEVEK_id_PRISPEVEK=p.id_prispevek AND u.id_UZIVATEL=".$id_uzivatele);
        return $k_posouzeni;
    }

    public function addRecenze($id_prispevku){
        $columns = "PRISPEVEK_id_PRISPEVEK";
        $values = "$id_prispevku";
        $this->insertIntoTable(TABLE_RECENZE, $columns, $values);
    }

    public function editPosudku(string $originalita, string $tema, string $tech_kval, string $jazyk_kval, string $doporuc, string $poznamky, string $id_prispevku){
        $stmt = "originalita = '$originalita', tema = '$tema', technicka_kvalita = '$tech_kval', jazykova_kvalita = '$jazyk_kval', doporuceni = '$doporuc', poznamky = '$poznamky'";
        $this->updateInTable(TABLE_RECENZE, $stmt, "$id_prispevku");
    }

    public function getRecenzenty(){
        return $this->selectFromTable(TABLE_UZIVATEL, "ROLE_id_ROLE=2");
    }

    public function getReceptyRecenze(){
        return $this->selectFromTable(TABLE_PRISPEVEK.", ".TABLE_RECENZE, "prispevek.id_PRISPEVEK=recenze.PRISPEVEK_id_PRISPEVEK");
    }

    public function priradRecenzenta($id_uzivatele, $id_recenze){
        $this->updateInTable(TABLE_RECENZE, "recenze.id_UZIVATEL=".$id_uzivatele, "recenze.id_RECENZE=".$id_recenze);
    }
    
///////////////////  KONEC: Specificke funkce /////////////////
}
?>