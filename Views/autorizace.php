

<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['autorizace']['title'], $tplData['menu']);
?>
<div class="container mt-4">
        <h1>Autorizace</h1>
            <form class="autorizace" method="post" action="">
                Email: <input type="email" class="form-control" name="email" id="emal" value="" placeholder="Napište email" required>
                <?php echo $tplData['email']['error'];?>
                <br><br>
                Heslo: <input type="password" class="form-control" name="heslo" id="heslo" value="" placeholder="Napište heslo" required>
                <?php echo $tplData['heslo']['error'];?>
                <br><br>
                <button class="btn btn-success" name="action" value="vstup" type="submit" >Vstup</button><br>
            </form>
</div>
<?php
    $temp->getHTMLFooter();
?>



