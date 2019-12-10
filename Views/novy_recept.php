<?php
global $tplData;
require_once "TemplateBasics.class.php";
$temp = new TemplateBasics();
$temp->getHTMLHeader(WEB_PAGES['novyRecept']['title'], $tplData['menu']);
?>
<div class="container mt-4" id="hlavni">
<!--    <h1>Přidání nového receptu</h1>-->
    <form class="novy_recept" method="post" id="novy_rcept" action="">
        Název receptu:<br>
        <input type="text" name="nazev"  id="nazev" value="" placeholder="Název receptu" required>
        <br><br>
        Popis receptu:<br>
        <textarea name="popis" rows="4" cols="30" id="popis" ></textarea>
        <br><br>
        PDF Soubor:<br>
        <input type="file" name="soubor" accept=application/pdf" id="soubor" multiple>
        <br><br>
        <button class="btn btn-success" name="action" value="odeslat" type="submit">Odeslat</button><br>
    </form>
</div>
<?php

$temp->getHTMLFooter();
?>

