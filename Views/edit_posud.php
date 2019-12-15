<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['editPosud']['title'], $tplData['menu']);
?>
    <div class="container mt-4" id="hlavni">

            <!--    <h1>Editace posudku</h1>-->
            <form class="editPosud" method="post" action="" id="forms">
                <h1>Posouzení receptů</h1>
                <br><br>
                <label>Recept:<br><select name="recenze" class="form-control" required>
                    <option value="">Zvolte recept</option>
                    <?php
                    for($i = 0; $i < count($tplData['obsah']); $i++){
                        echo "<option value='".$tplData['obsah'][$i]['id_RECENZE']."'>".$tplData['obsah'][$i]['nazev']."</option>";
                    }
                    ?>
                </select>
                <label>Originalita:<br><select name="originalita" class="form-control" required>
                        <option value="1">1 - špatně</option>
                        <option value="2">2 - docéla špatně</option>
                        <option value="3">3 - docéla dobře </option>
                        <option value="4">4 - dobře</option>
                        <option value="5">5 - vyborně</option>
                </select></label>
                <br>
                <label>Téma:<br><select name="tema" class="form-control" required>
                        <option value="1">1 - špatně</option>
                        <option value="2">2 - docéla špatně</option>
                        <option value="3">3 - docéla dobře </option>
                        <option value="4">4 - dobře</option>
                        <option value="5">5 - vyborně</option>
                </select></label>
                <br>
                <label>Technická kvalita:<br><select name="technicka_kvalita" class="form-control" required>
                        <option value="1">1 - špatně</option>
                        <option value="2">2 - docéla špatně</option>
                        <option value="3">3 - docéla dobře </option>
                        <option value="4">4 - dobře</option>
                        <option value="5">5 - vyborně</option>
                </select></label>
                <br>
                <label>Jazyková kvalita:<br><select name="jazykova_kvalita" class="form-control" required>
                        <option value="1">1 - špatně</option>
                        <option value="2">2 - docéla špatně</option>
                        <option value="3">3 - docéla dobře </option>
                        <option value="4">4 - dobře</option>
                        <option value="5">5 - vyborně</option>
                </select></label>
                <br>
                <label>Doporučení:<br><select name="doporuceni" class="form-control" required>
                        <option value="1">1 - špatně</option>
                        <option value="2">2 - docéla špatně</option>
                        <option value="3">3 - docéla dobře </option>
                        <option value="4">4 - dobře</option>
                        <option value="5">5 - vyborně</option>
                </select></label>
                <br>

                <label>Poznámky:<br><textarea name="poznamky" class="form-control" rows="4" cols="30" id="popis" placeholder="Popiště svůj recept"></textarea></label>
                <br><br>
                <button class="btn btn-success" name="action" value="odeslat" type="submit">Odeslat</button><br>
                <br>
            </form>


    </div>


<?php
    $temp->getHTMLFooter();
?>
