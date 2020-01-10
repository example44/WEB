<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['uvodni']['title'], $tplData['menu']);
?>
    <div class="container mt-4 text-center" id="headForms" >
        <h1 id="uvodni header">Vitáme Vás na portalu Playground.cz</h1>
        <br>
    </div>




    <div class="container mt-4" id="text">
        <h1>O portálu</h1>
        <?php echo $tplData['obsah']; ?>
    </div>
    <br><br>

<?php
    $temp->getHTMLFooter();


