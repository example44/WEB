<?php
global $tplData;
require_once "TemplateBasics.class.php";
$temp = new TemplateBasics();
$temp->getHTMLHeader(WEB_PAGES['editRecenze']['title'], $tplData['menu']);
?>
<div class="container mt-4" id="hlavni">

    <div class="row-padded">
        <div class="form-group text-center">
            <form class="editPosud" method="post" action="" id="forms" enctype="multipart/form-data">
                <h1>Editace recenze</h1>
                <br><br>
                <label>Recenze:<br><select name="recenze" class="form-control" id="zvol_recep" onchange="getRecenze(this.value)" required>
                        <option value="">Zvolte recenze</option>
                        <?php
                        for($i = 0; $i < count($tplData['obsah']); $i++){
                            echo "<option value='" . $tplData['obsah'][$i]['id_PRISPEVEK'] . "'>" . $tplData['obsah'][$i]['nazev'] . "</option>";
                        }
                        ?>
                    </select></label>
                <br>
                <label>Název recenze:<br> <input type="text" class="form-control" name="nazev" id="nazev" value="<?php echo $tplData['nazev']['value'];?>" placeholder="Zadejte název recenze" required></label>
                <span class="error"> <?php echo $tplData['nazev']['error'];?></span>
                <br>
                <br>
                <label>Popis recenze: <br><textarea name="popis" rows="4" cols="30" id="popis" placeholder="Popiště vaše recenze" required><?php echo $tplData['popis']['value'];?></textarea></label>
                <span class="error"> <?php echo $tplData['popis']['error'];?></span>
                <br>
                <br>
                <label>PDF Soubor: <span id="soubor_name"></span><br><input type="file" name="soubor" accept="application/pdf" id="soubor"></label>
                <br><br>
                <button class="btn" name="action" value="odeslat" type="submit">Odeslat</button><br>
                <br>
            </form>
        </div>
    </div>


</div>

<script>
    function getRecenze(id_pris) {
        if (id_pris == "") {
            document.getElementById("nazev").value = "";
            document.getElementById("popis").value = "";
            document.getElementById("soubor_name").innerText = "";
            return;
        } else {
            const xmlhttp = getXmlHttp();
            xmlhttp.onreadystatechange = function () {
                if(this.readyState == 4 && this.status == 200){
                    const jsonObj =JSON.parse(this.responseText);
                    console.log(jsonObj);
                    document.getElementById("nazev").value = jsonObj['2'];
                    document.getElementById("popis").value = jsonObj['1'];
                    document.getElementById("soubor_name").innerText = jsonObj['5'];
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
