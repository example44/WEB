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
        $list_receptu = $this->selectFromTable(TABLE_PRISPEVEK);
        return $list_receptu;
    }

    public function getAutorRecepts(int $id_autora){
        $recepty_autora = $this->selectFromTable(TABLE_PRISPEVEK, "$id_autora");
        return $recepty_autora;
    }

    public function deletePrispevek(int $id_prispevku){
        $this->deleteFromTable(TABLE_PRISPEVEK, "$id_prispevku");
    }

    public function addPrispevek(string $obsah, string $nazev, string  $rozhodnuti, int $id_uzivatele){
        // sloupce
        $columns = "obsah, nazev, rozhodnuti, uzivatel_id_uzivatel";
        // hodnoty
        $values = "'$obsah', '$nazev', '$rozhodnuti', '$id_uzivatele'";
        return $this->insertIntoTable(TABLE_PRISPEVEK, $columns, $values);
    }

    //ohodnoceni jak vytvorit
//    public function getSeznamKPosouzeni($id_uzivatele){
//        $k_posouzeni = $this->selectFromTable(  "$id_uzivatele");
//        return $k_posouzeni;
//    }

    public function addRecenze(string $originalita, string $tema, string $tech_kval, string $jazyk_kval, string $doporuc, string $poznamky, string $id_uzivatelu, string $id_prispevku){
        $columns = "originalita, tema, technicka_kvalita, jazykova_kvalita, doporuceni, poznamky, id_UZIVATEL, PRISPEVEK_id_PRISPEVEK";
        $values = "'$originalita', '$tema', '$tech_kval', '$jazyk_kval', '$doporuc', '$poznamky', '$id_uzivatelu', '$id_prispevku'";
        $this->insertIntoTable(TABLE_RECENZE, $columns, $values);
    }

    public function editPosudku(string $originalita, string $tema, string $tech_kval, string $jazyk_kval, string $doporuc, string $poznamky, string $id_prispevku){
        $stmt = "originalita = '$originalita', tema = '$tema', technicka_kvalita = '$tech_kval', jazykova_kvalita = '$jazyk_kval', doporuceni = '$doporuc', poznamky = '$poznamky'";
        $this->updateInTable(TABLE_RECENZE, $stmt, "$id_prispevku");
    }
///////////////////  KONEC: Specificke funkce /////////////////
}
?>