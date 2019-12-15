
<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['nematePravo']['title'], $tplData['menu']);
?>
    <div class="container" id="nemate_pravo" >
        <h1>Chyba přístupu</h1>
        <br>
        <br>
        Máte jinou roli, pro přístup na tuto stranku kontaktujte administratory test1@test.com.
    </div>
<?php
    $temp->getHTMLFooter();
?>

