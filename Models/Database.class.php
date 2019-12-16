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

    public function selectFromTable(string $tableName, string $where = "", string $orderBy = ""){
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

///////////////////  KONEC: Specificke funkce /////////////////
/// ////////////// NOVE FUNKCE   ////////////////
    public function getUserAutoriz(string $email, string $heslo){
        $q = "SELECT * FROM ".TABLE_UZIVATEL." WHERE email=:userEm AND heslo=:userPas;";
        $stmt = $this->pdo->prepare($q);
        $stmt->execute(array(
            ":userEm" => $email,
            ":userPas" => $heslo
        ));
        return $stmt->fetchAll();
    }


    public function addNewUser(string $email, string $heslo, string  $name, $role ){
        $columns = "email, heslo, username, id_role";
        $q = "INSERT INTO ".TABLE_UZIVATEL."($columns) VALUES (:userEm, :userPas, :userName, :userRole)";
        $stmt = $this->pdo->prepare($q);
        $stmt->execute(array(
            ":userEm" => $email,
            ":userPas" => $heslo,
            ":userName" => $name,
            ":userRole" => $role
        ));
    }

    public function getVerejRecept(){
        $list_receptu = $this->selectFromTable(TABLE_PRISPEVEK, "rozhodnuti = 1");
        return $list_receptu;
    }

    public function getAutorRecepts(int $id_autora){
        $recepty_autora = $this->selectFromTable(TABLE_PRISPEVEK, "id_UZIVATEL = $id_autora");
        return $recepty_autora;
    }

    public function deletePrispevek(int $id_prispevku){
        $this->deleteSouborPrispevku($id_prispevku);
        $this->deleteRecenPrispevku($id_prispevku);
        $q = "DELETE FROM ".TABLE_PRISPEVEK." WHERE id_PRISPEVEK=:idPrisp;";
        $stmt = $this->pdo->prepare($q);
        $stmt->execute(array(
            ":idPrisp" => $id_prispevku
        ));
    }

    public function deleteRecenPrispevku(int $id_prispevku){
        $q = "DELETE FROM ".TABLE_RECENZE." WHERE id_PRISPEVEK=:idPrisp;";
        $stmt = $this->pdo->prepare($q);
        $stmt->execute(array(
            ":idPrisp" => $id_prispevku
        ));
    }

    public function deleteSouborPrispevku(int $id_prispevku){
        $fileName = $this->getFileName($id_prispevku)[0]['nazev'];
        var_dump($fileName);
        $q = "DELETE FROM ".TABLE_SOUBOR." WHERE id_PRISPEVEK=:idPrisp;";
        $stmt = $this->pdo->prepare($q);
        $stmt->execute(array(
            ":idPrisp" => $id_prispevku
        ));

        unlink("soubory/".$fileName);
    }

    public function getFileName(int $id_prispevku){
        $q = "SELECT nazev FROM ".TABLE_SOUBOR." WHERE id_PRISPEVEK=:idPrisp;";
        $fileName = $this->pdo->prepare($q);
        $fileName->execute(array(
            ":idPrisp" => $id_prispevku
        ));
        return $fileName->fetchAll();
    }

    public function addPrispevek(string $obsah, string $nazev, int $id_uzivatele){
        $columns = "obsah, nazev, id_UZIVATEL";
        $q = "INSERT INTO ".TABLE_PRISPEVEK."($columns) VALUES (:obsah, :nazev, :user_id)";
        $stmt = $this->pdo->prepare($q);
        $stmt->execute(array(
            ":obsah" => $obsah,
            ":nazev" => $nazev,
            ":user_id" => $id_uzivatele
        ));
    }

    public function addSoubor(string $nazev, string $id_prispevek){
        $columns = "nazev, id_PRISPEVEK";
        $q = "INSERT INTO ".TABLE_SOUBOR."($columns) VALUES (:nazev, :id_prispevek)";
        $stmt = $this->pdo->prepare($q);
        $stmt->execute(array(
            ":nazev" => $nazev,
            ":id_prispevek" => $id_prispevek
        ));
    }

    public function getVseRecepty(){
        $list_receptu = $this->selectFromTable(TABLE_PRISPEVEK);
        return $list_receptu;
    }

    public function getRecenzenty(){
        return $this->selectFromTable(TABLE_UZIVATEL, "id_ROLE=2");
    }

    public function deleteRecenze(int $id_recenze){
        $q = "DELETE FROM ".TABLE_RECENZE." WHERE id_RECENZE=:idRec;";
        $stmt = $this->pdo->prepare($q);
        $stmt->execute(array(
            ":idRec" => $id_recenze
        ));
    }

    public function zverejnit($id_prispevek){
        return $this->updateInTable(TABLE_PRISPEVEK, "rozhodnuti = 1", "$id_prispevek");
    }

    public function getRecenzeKReceptu($id_prispevek){
        $q = "SELECT * FROM ".TABLE_RECENZE." WHERE id_PRISPEVEK=:idPrisp;";
        $fileName = $this->pdo->prepare($q);
        $fileName->execute(array(
            ":idPrisp" => $id_prispevek
        ));
        return $fileName->fetchAll();
    }

    public function addRecenze($id_uziv, $id_prispevek){
        $columns = "id_UZIVATEL, id_PRISPEVEK";
        $q = "INSERT INTO ".TABLE_RECENZE."($columns) VALUES (:idUziv, :id_prispevek)";
        $stmt = $this->pdo->prepare($q);
        $stmt->execute(array(
            ":idUziv" => $id_uziv,
            ":id_prispevek" => $id_prispevek
        ));
    }

    public function getSeznamKPosouzeni($id_uzivatele){
        $k_posouzeni = $this->selectFromTable( TABLE_RECENZE." r, ".TABLE_PRISPEVEK." p", "r.id_PRISPEVEK=p.id_prispevek AND r.id_UZIVATEL=".$id_uzivatele." AND p.rozhodnuti=0");
        return $k_posouzeni;
    }

    public function editPosudku(string $id_recenze, string $originalita, string $tema, string $tech_kval, string $jazyk_kval, string $doporuc, string $poznamky){
        $q = "UPDATE ".TABLE_RECENZE." SET originalita =:orig, tema =:tema, technicka_kvalita =:tech, jazykova_kvalita =:jazyk, doporuceni =:dopor, poznamky =:pozn WHERE id_RECENZE=:id_rec";
        $stmt = $this->pdo->prepare($q);

        $stmt->execute(array(
            ":orig" => $originalita,
            ":tema" => $tema,
            ":tech" => $tech_kval,
            ":jazyk" => $jazyk_kval,
            ":dopor" => $doporuc,
            ":pozn" => $poznamky,
            ":id_rec" => $id_recenze
        ));
        var_dump($stmt);
    }

    public function getSouborRecepta($id_pris){
        $q = "SELECT * FROM ".TABLE_SOUBOR." WHERE id_PRISPEVEK=:idPrisp;";
        $stmt = $this->pdo->prepare($q);
        $stmt->execute(array(
            ":idPrisp" => $id_pris
        ));
        return $stmt->fetchAll();
    }

    public function getRecenze($id_recenze){
        $q = "SELECT * FROM ".TABLE_RECENZE." WHERE id_RECENZE=:idRec;";
        $fileName = $this->pdo->prepare($q);
        $fileName->execute(array(
            ":idRec" => $id_recenze
        ));
        return $fileName->fetchAll();
    }

    public function getAllRole(){
        return $this->selectFromTable( TABLE_ROLE);
    }
}
?>