<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['autorizace']['title'], $tplData['menu']);
?>
            <form class="autorizace container mt-4 " id="forms" role="form" method="post" action="">
                <div class="row-padded">
                        <div class="form-group text-center">
                            <h1>Autorizace</h1>
                            <br><br>
                                <label>Email <br><input type="email" class="form-control" name="email" id="emal" value="<?php echo $tplData['email']['value'];?>" placeholder="Napište email" required></label>
                                <br>
                                <span class="error" id="usName"> <?php echo $tplData['email']['error'];?></span>
                                <br>
                                <label>Heslo <br><input type="password" class="form-control" name="heslo" id="heslo" value="" placeholder="Napište heslo" required></label>
                                <br>
                                <span class="error" id="usName"> <?php echo $tplData['heslo']['error'];?></span>
                                <br>
                                <br>
                                <button class="btn" id="button" name="action" value="vstup" type="submit" >Vstup</button><br>
                        </div>
                    </div>
                </form>



<?php
    $temp->getHTMLFooter();
?>
