<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['receptyKPosouz']['title'], $tplData['menu']);

$res = '<div class="container mt-4" id="tables">
        <h1>Tvoje recenze</h1>
        <br>
        <table class="table table-sm table-bordered table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Název</th>
                        <th>Průměr</th>
                        <th>Obsah receptu</th>
                        <th>Stáhnout</th>
                    </tr>
                </thead>
                <tbody class="table-dark text-center">';
for($i = 0; $i < count($tplData['obsah']); $i++) {
    $nazev = $tplData['obsah'][$i]['nazev'];
    $obsah = $tplData['obsah'][$i]['obsah'];
    $orig = $tplData['obsah'][$i]['originalita'];
    $tema = $tplData['obsah'][$i]['tema'];
    $tech = $tplData['obsah'][$i]['technicka_kvalita'];
    $jazyk = $tplData['obsah'][$i]['jazykova_kvalita'];
    $dopor = $tplData['obsah'][$i]['doporuceni'];
    $soubor = $tplData['obsah'][$i]['nazev_souboru'][0]['nazev'];
    $prumer = ($orig + $tema + $tech + $jazyk + $dopor)/5;
    $poznamky = $tplData['obsah'][$i]['poznamky'];
    $id = $tplData['obsah'][$i]['id_PRISPEVEK'];
    $res .= '<tr class="position-relative">
                <td>'.$nazev.'</td>
                <td>'.$prumer.'</td>
                 <td class="text-center">
                    <button onclick="chan('.$i.')" id="butt'.$i.'" data-toggle="collapse" type="button" class="btn" data-target="#collap'.$i.'">Zobrazit obsah</button>
                        <div id="collap'.$i.'" class="collapse">
                            '.$obsah.'
                            <br>
                            Poznamky: '.$poznamky.'
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

