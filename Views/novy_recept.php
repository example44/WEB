<?php
global $tplData;
require_once "TemplateBasics.class.php";
$temp = new TemplateBasics();
$temp->getHTMLHeader(WEB_PAGES['novyRecept']['title'], $tplData['menu']);
?>
<div class="container mt-4" id="hlavni">
    <h1></h1>
    <form class="novy_recept" method="post" action="">
        Název receptu: <input type="text" class="form-control" name="recept_naz"  id="recept_naz" value="" placeholder="Zadejte název receptu">
        <br><br>
        Popis receptu: <textarea rows="10" cols="45" name="recept_ob" id="recept_ob" value=""></textarea>
        <br><br>
        <button class="btn btn-success" name="action" value="create_recept" type="submit">Odeslat</button><br>
    </form>
</div>
<?php
$temp->getHTMLFooter();
?>

