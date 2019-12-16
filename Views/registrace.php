<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['registrace']['title'], $tplData['menu']);
?>
            <div class="container mt-4" >
                <div class="row-padded">
                    <div class="form-group text-center">
                        <form class="prihlaseni" method="post" action="" id="forms" oninput="over_pas.value=(heslo.value == heslo_znovu.value)?'Hesla jsou stejná':'Hesla nejsou stejná'">
                                <h1>Registrace</h1>
                                <br><br>
                                <label >Uživatelské jmeno: <input type="text" class="form-control" name="name"  id="name" value="<?php echo $tplData['username']['value'];?>" oninput="kontrolUsername(this.value)" placeholder="Napište username" required></label><br>
                                <span class="error" id="usName"> <?php echo $tplData['username']['error'];?></span>
                                <br><br>
                                <label>Email: <input type="email" class="form-control" name="email" id="email" value="<?php echo $tplData['email']['value'];?>" oninput="kontrolEmail(this.value)" placeholder="Napište email" required></label><br>
                                <span class="error" id="usEmail"> <?php echo $tplData['email']['error'];?></span>
                                <br><br>
                                <label>Heslo: <input type="password" class="form-control" name="heslo" id="heslo" value="<?php echo $tplData['heslo']['value'];?>" placeholder="Napište heslo" required></label><br>
                                <span class="error"> <?php echo $tplData['heslo']['error'];?></span>
                                <br><br>
                                <label>Heslo znovu: <input type="password" class="form-control" name="heslo_znovu" id="heslo_znovu" value="<?php echo $tplData['heslo_znovu']['value'];?>" placeholder="Zopakujte heslo" required></label><br>
                                <span class="error"> <?php echo $tplData['heslo_znovu']['error'];?></span>
                                <br>
                                <output name="over_pas" for="heslo heslo_znovu"></output>
                                <br><br>
                                <label>Typ uživatele:<br>
                                    <select name="role" class="form-control" >
                                        <option value="">Zvolte role</option>
                                        <?php
                                            for($i = 0; $i < count($tplData['role_mozne']); $i++){
                                                echo "<option value='".$tplData['role_mozne'][$i]['id_ROLE']."'>".$tplData['role_mozne'][$i]['nazev']."</option>";
                                            }
                                        ?>
                                    </select>
                                </label><br>
                                <span class="error"><?php echo $tplData['role']['error'];?></span>
                                <br><br>
                                <button class="btn btn-success btn-lg" name="action" value="registrace" type="submit" id="button">Zaregistrovat</button>
                            <br><br>
                        </form>
                    </div>
                </div>
            </div>

<script>
function kontrolUsername(str) {
    if (str == "") {
        document.getElementById("usName").innerHTML = "";
        return;
    } else {
        const xmlhttp = getXmlHttp();
        xmlhttp.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200){
        document.getElementById("usName").innerHTML = this.responseText;
        }
        };
        xmlhttp.open("GET", "ajax-server.php?username="+str, true);
        xmlhttp.send();
    }
}

function kontrolEmail(str) {
    if (str == "") {
        document.getElementById("usEmail").innerHTML = "";
        return;
    } else {
        const xmlhttp = getXmlHttp();
        xmlhttp.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("usEmail").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "ajax-server.php?email="+str, true);
        xmlhttp.send();
    }
}
</script>
    <?php
        $temp->getHTMLFooter();
    ?>
