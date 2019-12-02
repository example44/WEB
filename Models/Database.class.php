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
        return $this->selectFromTable(TABLE_UZIVATEL);
    }

    public function addNewUser(string $email, string $heslo, string  $name ){
        // sloupce
        $columns = "email, heslo, username, role_id_role";
        // hodnoty
        $values = "'$email', '$heslo', '$name', '1'";
        return $this->insertIntoTable(TABLE_UZIVATEL, $columns, $values);
    }

    public function getAllRights(){
        // ziskam vsechny uzivatele z DB razene dle ID a vratim je
        $users = $this->selectFromTable(TABLE_PRAVO, "", "vaha ASC, nazev ASC");
        return $users;
    }
///////////////////  KONEC: Specificke funkce /////////////////
}
?>