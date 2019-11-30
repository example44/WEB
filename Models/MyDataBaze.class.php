<?php
//////////////////////////////////////////////////////////////
////////////// Vlastni trida pro praci s databazi ////////////////
//////////////////////////////////////////////////////////////

/**
 * Vlastni trida spravujici databazi.
 */
require_once "nastaven.inc.php";
class MyDatabaze {

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
///////////////////  KONEC: Specificke funkce /////////////////
}
?>