
<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['nematePravo']['title'], $tplData['menu']);
?>
    <div class="container mt-4" id="nemate_pravo" >
        <div class="row-padded">
            <div class="form-group text-center">
                <h1>Chyba přístupu</h1>
                <br>
                <br>
                Máte jinou roli, pro přístup na tuto stranku kontaktujte administratory
            </div>
        </div>
    </div>
<?php
    $temp->getHTMLFooter();
?>

