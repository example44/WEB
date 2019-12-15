<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['receptyKPosouz']['title'], $tplData['menu']);

$res = '<div class="container mt-4" id="tables">
        <h1>Tvoje recepty</h1>
        <br>
        <table class="table table-sm table-bordered table-striped table-hover">
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
    $prumer = ($orig + $tema + $tech + $jazyk + $dopor)/5.0;
    $id = $tplData['obsah'][$i]['id_PRISPEVEK'];
    $res .= '<tr class="position-relative">
                <td onclick="goToPage(`index.php?page=editPosud`)">'.$nazev.'</td>
                <td>'.$prumer.'</td>
                 <td class="text-center">
                    <button id="butt" onclick="chan()" data-toggle="collapse" type="button" class="btn btn-primary" data-target="#collap'.$i.'">Zobrazit obsah</button>
                        <div id="collap'.$i.'" class="collapse">
                            '.$obsah.'
                        </div>
                </td>
                <td></td>
            </tr>';
}
$res .= '</tbody></table></div>';
echo $res;

    $temp->getHTMLFooter();
?>