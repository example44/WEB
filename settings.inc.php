<?php
//////////////////////////////////////////////////////////////////
/////////////////  Globalni nastaveni aplikace ///////////////////
//////////////////////////////////////////////////////////////////

//// Pripojeni k databazi ////

/** Adresa serveru. */
define("DB_SERVER","localhost"); // https://students.kiv.zcu.cz
/** Nazev databaze. */
define("DB_NAME","conference");
/** Uzivatel databaze. */
define("DB_USER","root");
/** Heslo uzivatele databaze */
define("DB_PASS","");


//// Nazvy tabulek v DB ////

/** Tabulka s recenzemi. */
define("TABLE_RECENZE", "recenze");
/** Tabulka s roli. */
define("TABLE_ROLE", "role");
/** Tabulka s prispevek. */
define("TABLE_PRISPEVEK", "prispevek");
/** Tabulka s soubory. */
define("TABLE_SOUBOR", "soubor");
/** Tabulka s uzivateli. */
define("TABLE_UZIVATEL", "uzivatel");


//// Dostupne stranky webu ////

/** Adresar kontroleru. */
const DIRECTORY_CONTROLLERS = "Controllers";
/** Adresar modelu. */
const DIRECTORY_MODELS = "Models";
/** Adresar sablon */
const DIRECTORY_VIEWS = "Views";

/** Dostupne webove stranky. */
const WEB_PAGES = array(

    "uvodni" => array("file_name" => "UvodniStranka.class.php",
                      "class_name" => "UvodniStranka",
                      "role" => array(0,1,2,3),
                      "template_name" => "uvodni_stranka.php",
                      "title" => "Úvodní stránka"),
    "recepty" => array("file_name" => "Recepty.class.php",
                       "class_name" => "Recepty",
                       "role" => array(0,1,2,3),
                       "template_name" => "recepty.php",
                       "title" => "Recepty"),
    "registrace" => array("file_name" => "Registrace.class.php",
                          "class_name" => "Registrace",
                          "template_name" => "registrace.php",
                          "role" => array(0),
                          "title" => "Registrace"),
    "autorizace" => array("file_name" => "Autorizace.class.php",
                          "class_name" => "Autorizace",
                          "template_name" => "autorizace.php",
                          "role" => array(0),
                          "title" => "Autorizace"),
    "recepAutor" => array("file_name" => "ReceptAutor.class.php",
                            "class_name" => "ReceptAutor",
                            "template_name" => "recept_autor.php",
                            "role" => array(3),
                            "title" => "Seznam receptů"),
    "novyRecept" => array("file_name" => "NovyRecept.class.php",
                            "class_name" => "NovyRecept",
                            "template_name" => "novy_recept.php",
                            "role" => array(3),
                            "title" => "Nový recept"),
    "editRecept" => array("file_name" => "EditRecept.class.php",
                         "class_name" => "EditRecept",
                         "template_name" => "edit_recept.php",
                         "role" => array(3),
                         "title" => "Editace receptů"),
    "receptyKPosouz" => array("file_name" => "ReceptyKPosouz.class.php",
                            "class_name" => "ReceptyKPosouz",
                            "template_name" => "recepty_k_posouz.php",
                            "role" => array(2),
                            "title" => "Seznam receptů k posouzení"),
    "editPosud" => array("file_name" => "EditPosud.class.php",
                            "class_name" => "EditPosud",
                            "template_name" => "edit_posud.php",
                            "role" => array(2),
                            "title" => "Editace posudku"),
    "seznamAdmina" => array("file_name" => "SeznamAdmina.class.php",
                            "class_name" => "SeznamAdmina",
                            "template_name" => "seznam_admina.php",
                            "role" => array(1),
                            "title" => "Seznam receptů"),
    "spravaUziv" => array("file_name" => "SpravaUziv.class.php",
                            "class_name" => "SpravaUziv",
                            "template_name" => "sprava_uziv.php",
                            "role" => array(1),
                            "title" => "Správa uživatelů"),
    "nematePravo" => array("file_name" => "NematePravo.class.php",
                            "class_name" => "NematePravo",
                            "template_name" => "nemate_pravo.php",
                            //"role" => array(0,1,2,3),
                            "title" => "Chyba přístupu"),
);

/** Klic defaultni webove stranky. */
const DEFAULT_WEB_PAGE_KEY = "uvodni";

?>