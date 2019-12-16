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
                <label>Recept:<br><select name="recenze" class="form-control" id="zvol_recep" onchange="getRecenze(this.value)" required>
                    <option value="">Zvolte recept</option>
                    <?php
                    for($i = 0; $i < count($tplData['obsah']); $i++){
                            echo "<option value='" . $tplData['obsah'][$i]['id_RECENZE'] . "'>" . $tplData['obsah'][$i]['nazev'] . "</option>";
                    }
                    ?>
                </select></label>
                <br>
                <label>Originalita:<br><select name="originalita" id="originalita" class="form-control" required>
                        <option value="1">1 - špatně</option>
                        <option value="2">2 - docéla špatně</option>
                        <option value="3">3 - docéla dobře </option>
                        <option value="4">4 - dobře</option>
                        <option value="5">5 - vyborně</option>
                </select></label>
                <br>
                <label>Téma:<br><select name="tema" id="tema" class="form-control" required>
                        <option value="1">1 - špatně</option>
                        <option value="2">2 - docéla špatně</option>
                        <option value="3">3 - docéla dobře </option>
                        <option value="4">4 - dobře</option>
                        <option value="5">5 - vyborně</option>
                </select></label>
                <br>
                <label>Technická kvalita:<br><select name="jazykova_kvalita" id="jazykova_kvalita"  class="form-control" required>
                        <option value="1">1 - špatně</option>
                        <option value="2">2 - docéla špatně</option>
                        <option value="3">3 - docéla dobře </option>
                        <option value="4">4 - dobře</option>
                        <option value="5">5 - vyborně</option>
                </select></label>
                <br>
                <label>Jazyková kvalita:<br><select name="technicka_kvalita" id="technicka_kvalita" class="form-control" required>
                        <option value="1">1 - špatně</option>
                        <option value="2">2 - docéla špatně</option>
                        <option value="3">3 - docéla dobře </option>
                        <option value="4">4 - dobře</option>
                        <option value="5">5 - vyborně</option>
                </select></label>
                <br>
                <label>Doporučení:<br><select name="doporuceni" id="doporuceni" class="form-control" required>
                        <option value="1">1 - špatně</option>
                        <option value="2">2 - docéla špatně</option>
                        <option value="3">3 - docéla dobře </option>
                        <option value="4">4 - dobře</option>
                        <option value="5">5 - vyborně</option>
                </select></label>
                <br>

                <label>Poznámky:<br><textarea name="poznamky" class="form-control" rows="4" cols="30" id="poznamky" placeholder="Popiště svůj recept"></textarea></label>
                <br><br>
                <button class="btn btn-success" name="action" value="odeslat" type="submit">Odeslat</button><br>
                <br>
            </form>


    </div>

<script>
    function getRecenze(id_pris) {
        if (id_pris == "") {
            return;
        } else {
            const xmlhttp = getXmlHttp();
            xmlhttp.onreadystatechange = function () {
                if(this.readyState == 4 && this.status == 200){
                    const jsonObj =JSON.parse(this.responseText);
                    console.log(jsonObj);
                    document.getElementById("originalita").value = jsonObj['1'];
                    document.getElementById("tema").value = jsonObj['2'];
                    document.getElementById("jazykova_kvalita").value = jsonObj['3'];
                    document.getElementById("technicka_kvalita").value = jsonObj['4'];
                    document.getElementById("doporuceni").value = jsonObj['5'];
                    document.getElementById("poznamky").value = jsonObj['6'];
                }
            };
            xmlhttp.open("GET", "ajax-server.php?id_recenze="+id_pris, true);
            xmlhttp.send();
        }
    }
</script>
<?php
    $temp->getHTMLFooter();
?>
