<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['registrace']['title'], $tplData['menu']);
?>
        <div class="container mt-4" id="hlavni" style="">
                    <div style="color: ">
                        <form class="prihlaseni" method="post" action="">
                            <label>Username: <input type="text" class="form-control" name="name"  id="name" value="<?php echo $tplData['username']['value'];?>" placeholder="Napište username" required></label>
                            <span class="error"> <?php echo $tplData['username']['error'];?></span>
                            <br><br>
                            <label>Email: <input type="email" class="form-control" name="email" id="email" value="<?php echo $tplData['email']['value'];?>" placeholder="Napište email" required></label>
                            <span class="error"> <?php echo $tplData['email']['error'];?></span>
                            <br><br>
                            <label>Heslo: <input type="password" class="form-control" name="heslo" id="heslo" value="<?php echo $tplData['heslo']['value'];?>" placeholder="Napište heslo" required></label>
                            <span class="error"> <?php echo $tplData['heslo']['error'];?></span>
                            <br><br>
                            <label>Heslo znovu: <input type="password" class="form-control" name="heslo_znovu" id="heslo_znovu" value="<?php echo $tplData['heslo_znovu']['value'];?>" placeholder="Zopakujte heslo" required></label>
                            <span class="error"> <?php echo $tplData['heslo_znovu']['error'];?></span>
                            <br><br>
                            <label>Typ uživatele:<br>
                                <select name="role" class="form-control" >
                                    <option value=""></option>
                                    <?php
                                        for($i = 0; $i < count($tplData['role_mozne']); $i++){
                                            echo "<option value='".$tplData['role_mozne'][$i]['id_ROLE']."'>".$tplData['role_mozne'][$i]['nazev']."</option>";
                                        }
                                    ?>
                                </select>
                            </label>
                            <span class="error"><?php echo $tplData['role']['error'];?></span>
                            <br><br>


                            <button class="btn btn-success" name="action" value="registrace" type="submit" >Zaregistrovat</button><br>
                        </form>
                    </div>
        </div>

    <?php
        $temp->getHTMLFooter();
    ?>
