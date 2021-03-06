<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['recenze']['title'], $tplData['menu']);
?>
<div class="container mt-4" id="headForms">
    <h1>Recenze našich uživatelů</h1>
</div>
<?php
$res = '<div class="container mt-4 " id="forms"></div>
        <br>
        <table class="table table-sm table-bordered container mt-4">
             <thead class=" text-center " style="background-color: #032329; color:#377D8A">
             <tr>
                <th>Název recenze</th>
                <th>Autor</th>
                <th>Obsah recenze</th>
                <th>Stáhnout</th>
                </tr>
            </thead >
            <tbody class=" text-center" style="background-color: #14363C; color: #377D8A">';
for($i = 0; $i < count($tplData['obsah']); $i++) {
    $nazev = $tplData['obsah'][$i]['nazev'];
    $autor = $tplData['obsah'][$i]['id_UZIVATEL'];
    $obsah = $tplData['obsah'][$i]['obsah'];
    $id = $tplData['obsah'][$i]['id_PRISPEVEK'];
    $soubor = $tplData['obsah'][$i]['nazev_souboru'][0]['nazev'];
    $res .= '<tr class="position-relative">
                <td>'.$nazev.'</td>
                <td>'.$autor.'</td>
                <td class="text-center">
                    <button onclick="chan('.$i.')" id="butt'.$i.'" data-toggle="collapse" type="button" class="btn" data-target="#collap'.$i.'">Zobrazit obsah</button>
                        <div id="collap'.$i.'" class="collapse">
                            '.$obsah.'
                        </div>
                </td>
                <td><a href="soubory/'.$soubor.'" download><i class="fa fa-download"></i></a></td>
            </tr>
            <script>
                function chan(i) {
                    const txt = document.getElementById("butt"+i).innerText;
                    if(txt == "Zobrazit obsah"){
                        document.getElementById("butt"+i).innerText = "Skryt";
                    }else if(txt == "Skryt"){
                        document.getElementById("butt"+i).innerText = "Zobrazit obsah";
                    }
                }
            </script>';
}
$res .= '</tbody></table></div>';
echo $res;
$temp->getHTMLFooter();
?>
