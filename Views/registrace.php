
<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['registrace']['title'], $tplData['menu']);
?>
        <div class="container mt-4" id="hlavni" style="">
                <h1>Registrace</h1>
                    <div style="color: ">
                        <form class="prihlaseni" method="post" action="">
                            Username: <input type="text" class="form-control" name="name"  id="name" value="<?php echo $tplData['username']['value'];?>" placeholder="Napište username">
                            <?php $txt = $tplData['username']['error'];
                            echo "<span style='color: red'>* $txt</span>" ?>
                            <br><br>
                            Email: <input type="email" class="form-control" name="email" id="email" value="<?php echo $tplData['email']['value'];?>" placeholder="Napište email">
                            <span class="error">* <?php echo $tplData['email']['error'];?></span>
                            <br><br>
                            Heslo: <input type="password" class="form-control" name="heslo" id="heslo" value="<?php echo $tplData['heslo']['value'];?>" placeholder="Napište heslo">
                            <span class="error">* <?php echo $tplData['heslo']['error'];?></span>
                            <br><br>
                            Heslo znovu: <input type="password" class="form-control" name="heslo_znovu" id="heslo_znovu" value="<?php echo $tplData['heslo_znovu']['value'];?>" placeholder="Zopakujte heslo">
                            <span class="error">* <?php echo $tplData['heslo_znovu']['error'];?></span>
                            <br><br>
                            Typ uživatele:<br>
                                <select name="role" class="form-control" >
                                    <option value="">     </option>
                                    <option value="3">Autor</option>
                                    <option value="2">Recenzent</option>
                                </select>
                                <span class="error">* <?php echo $tplData['role']['error'];?></span>
                                <br><br>

                            <button class="btn btn-success" name="action" value="registrace" type="submit" >Zaregistrovat</button><br>
                        </form>
                    </div>
        </div>

    <?php
        $temp->getHTMLFooter();
    ?>
