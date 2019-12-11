<?php
global $tplData;
require_once "TemplateBasics.class.php";
$temp = new TemplateBasics();
$temp->getHTMLHeader(WEB_PAGES['novyRecept']['title'], $tplData['menu']);
?>
<div class="container mt-4" id="hlavni">
    <h1>Přidání nového receptu</h1>
    <form class="novy_recept" method="post" id="novy_rcept" action="">
        Název receptu: <br>
        <input type="text" class="form-control" name="recept_naz"  id="recept_naz" value="" placeholder="Zadejte název receptu">
        <br><br>
        Popis receptu: <br>
        <textarea name="recept_ob" rows="4" cols="30" id="recept_ob" value=""></textarea>
        <br><br>
        PDF Soubor:<br>
        <input type="file" name="soubor" accept="application/pdf" id="soubor" multiple>
        <br><br>
        <button class="btn btn-success" name="action" value="create_recept" type="submit">Odeslat</button><br>
    </form>
</div>
<?php
$temp->getHTMLFooter();
?>
