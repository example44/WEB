<?php
global $tplData;
require_once "TemplateBasics.class.php";
$temp = new TemplateBasics();
$temp->getHTMLHeader(WEB_PAGES['novy_recept']['title'], $tplData['menu']);
?>
<div class="container mt-4" id="hlavni">
    <h1></h1>
    <form class="novy_recept" method="post" action="">
        Název receptu: <input type="text" class="form-control" name="tema"  id="tema" value="" placeholder="Název receptu">
        <br><br>
        Popis receptu: <textarea rows="10" cols="45" name="popis" id="popis"></textarea>

        <button class="btn btn-success" name="action" value="odeslat" type="submit">Odeslat</button><br>
    </form>
</div>
<?php

$temp->getHTMLFooter();
?>

