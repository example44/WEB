<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['editPosud']['title'], $tplData['menu']);
?>
    <div class="container mt-4" id="hlavni">

            <!--    <h1>Editace posudku</h1>-->
            <form class="editPosud" method="post" id="novy_rcept" action="">
                Originalita: <br>
                <select name="originalita"class="form-control" required>
                    <option value="1">1 - nic originalního </option>
                    <option value="2">2 - </option>
                    <option value="3">3 - </option>
                    <option value="4">4 - </option>
                    <option value="5">5 - </option>
                </select>
                Téma: <br>
                <select name="tema"class="form-control" required>
                    <option value="1">1 -  </option>
                    <option value="2">2 - </option>
                    <option value="3">3 - </option>
                    <option value="4">4 - </option>
                    <option value="5">5 - </option>
                </select>
                Technická kvalita: <br>
                <select name="technicka_kvalita"class="form-control" required>
                    <option value="1">1 -  </option>
                    <option value="2">2 - </option>
                    <option value="3">3 - </option>
                    <option value="4">4 - </option>
                    <option value="5">5 - </option>
                </select>
                Jazyková kvalita: <br>
                <select name="jazykova_kvalita"class="form-control" required>
                    <option value="1">1 -  </option>
                    <option value="2">2 - </option>
                    <option value="3">3 - </option>
                    <option value="4">4 - </option>
                    <option value="5">5 - </option>
                </select>
                Doporučení: <br>
                <select name="doporuceni"class="form-control" required>
                    <option value="1">1 -  </option>
                    <option value="2">2 - </option>
                    <option value="3">3 - </option>
                    <option value="4">4 - </option>
                    <option value="5">5 - </option>
                </select>
                Poznámky:<br>
                <textarea name="poznamky" class="form-control" rows="4" cols="30" id="popis" ></textarea>
                <br><br>
                <button class="btn btn-success" name="action" value="odeslat" type="submit">Odeslat</button><br>
            </form>


    </div>


<?php
    $temp->getHTMLFooter();
?>
