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

/** Tabulka s pohadkami. */
define("TABLE_", "");
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

    "uvodni" => array("file_name" => "uvodni_stranka.php",
                      "class_name" => "UvodniStranka.class.php",
                      "title" => "Úvodní stránka"),
    "recepty" => array("file_name" => "recepty.php",
                       "class_name" => "Recepty.class.php",
                         "title" => "Recepty"),
    "o_portalu" => array("file_name" => "o_portalu.php",
                       "class_name" => "OPortalu.class.php",
                         "title" => "O portalu"),
    "registrace" => array("file_name" => "registrace.php",
                          "class_name" => "Registrace.class.php",
                            "title" => "Registrace"),
    "autorizace" => array("file_name" => "autorizace.php",
                          "class_name" => "Autorizace.class.php",
                             "title" => "Autorizace")
);

/** Klic defaultni webove stranky. */
const DEFAULT_WEB_PAGE_KEY = "uvodni";

?>