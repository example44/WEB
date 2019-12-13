<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['autorizace']['title'], $tplData['menu']);
?>
        <div class="container mt-4" id="hlavni" style="">
            <form class="autorizace" method="post" action="">
                <label>Email: <br><input type="email" class="form-control" name="email" id="emal" value="<?php echo $tplData['email']['value'];?>" placeholder="Napište email" required></label>
                <?php echo $tplData['email']['error'];?>
                <br>
                <br>
                <label>Heslo: <br><input type="password" class="form-control" name="heslo" id="heslo" value="" placeholder="Napište heslo" required></label>
                <?php echo $tplData['heslo']['error'];?>
                <br>
                <br>
                <button class="btn btn-success" name="action" value="vstup" type="submit" >Vstup</button><br>
            </form>
        </div>
<?php
    $temp->getHTMLFooter();
?>



