
<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['registrace']['title'], $tplData['menu']);
?>
        <div class="container mt-4" id="forms" >
            <div style="color: ">
                <div class="row-padded">
                    <div class="form-group text-center">
                        <form class="prihlaseni" method="post" action="">
                                <h1>Registrace</h1>
                                <br><br>
                                <label >Username <input type="text" class="form-control" name="name"  id="name" value="<?php echo $tplData['username']['value'];?>" placeholder="Napište username" required></label>
                                <span class="error"> <?php echo $tplData['username']['error'];?></span>
                                <br><br>
                                <label>Email <input type="email" class="form-control" name="email" id="email" value="<?php echo $tplData['email']['value'];?>" placeholder="Napište email" required></label>
                                <span class="error"> <?php echo $tplData['email']['error'];?></span>
                                <br><br>
                                <label>Heslo <input type="password" class="form-control" name="heslo" id="heslo" value="<?php echo $tplData['heslo']['value'];?>" placeholder="Napište heslo" required></label>
                                <span class="error"> <?php echo $tplData['heslo']['error'];?></span>
                                <br><br>
                                <label>Heslo znovu <input type="password" class="form-control" name="heslo_znovu" id="heslo_znovu" value="<?php echo $tplData['heslo_znovu']['value'];?>" placeholder="Zopakujte heslo" required></label>
                                <span class="error"> <?php echo $tplData['heslo_znovu']['error'];?></span>
                                <br><br>
                                <label>Typ uživatele<br>
                                    <select name="role" class="form-control" >
                                        <option value="">     </option>
                                        <option value="3">Autor</option>
                                        <option value="2">Recenzent</option>
                                    </select>
                                </label> <?php echo $tplData['role']['error'];?>
                                <br><br>
                            <button class="btn btn-success" name="action" id="button" value="registrace" type="submit" >Zaregistrovat</button>
                            <br><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php
        $temp->getHTMLFooter();
    ?>
