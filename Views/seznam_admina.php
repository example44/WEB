<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['seznamAdmina']['title'], $tplData['menu']);

$res = '<table class="table table-sm table-bordered table-striped table-hover">
            <thead class="table-dark text-center">
            <tr>
                <td rowspan="2">název receptů</td>
                <td rowspan="2">autor</td>
                <td colspan="8">recenze</td>
                <td rowspan="2">rozhodnutí</td>
            </tr>
            <tr>
                <td>recenzent</td>
                <td>originalita</td>
                <td>téma</td>
                <td>tech. část</td>
                <td>jazyk. část</td>
                <td>doporučení</td>
                <td>průměr</td>
                <td>vymazat</td>
            </tr>
            </thead>
            <tbody>';

for($i = 0; $i < count($tplData['obsah']); $i++) {
    $nazev = $tplData['obsah'][$i]['nazev'];
    $autor = $tplData['obsah'][$i]['UZIVATEL_id_UZIVATEL'];
    $id = $tplData['obsah'][$i]['id_PRISPEVEK'];
    $res .= '<tr>
                <td rowspan="3">'.$nazev.'</td>
                <td rowspan="3">'.$autor.'</td>';
    for($j = 0; $j < count($tplData['obsah'][$i]['recenze']); $j++) {
        if(!$j){
            $zver = '<td rowspan="3"><form method="post" action="">
                        <input type="hidden" name="recept" value="'.$id.'">
                        <button class="btn btn-warning" type="submit" name="action" value="zverejnit">Zveřejnit</button>
                    </form></td>';
        }else{
            $zver = '';
        }
        $id_recen = $tplData['obsah'][$i]['recenze'][$j][0];
        $id_recept =  $recenzent = $tplData['obsah'][$i]['recenze'][$j][8];
        $recenzent = $tplData['obsah'][$i]['recenze'][$j]['id_UZIVATEL'];
        $orig = $tplData['obsah'][$i]['recenze'][$j][1];
        $tema = $tplData['obsah'][$i]['recenze'][$j][2];
        $tech = $tplData['obsah'][$i]['recenze'][$j][3];
        $jazyk = $tplData['obsah'][$i]['recenze'][$j][4];
        $dopor = $tplData['obsah'][$i]['recenze'][$j][5];
        $prumer = ($orig + $tema + $tech + $jazyk + $dopor)/5;
        $res .= '<td>' . $recenzent . '</td>
                <td>' . $orig . '</td>
                <td>' . $tema . '</td>
                <td>' . $tech . '</td>
                <td>' . $jazyk . '</td>
                <td>' . $dopor . '</td>
                <td>' . $prumer . '</td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="recept" value="'.$id_recept.'">
                        <input type="hidden" name="recenze_del" value="'.$id_recen.'">
                        <button class="btn btn-warning" type="submit" name="action" value="delete">Smazat</button>
                    </form></td>'.$zver.'
                </tr>';
    }
}

$res .= '</tbody></table>';
echo $res;
    $temp->getHTMLFooter();
?>