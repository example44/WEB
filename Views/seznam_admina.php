<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['seznamAdmina']['title'], $tplData['menu']);
for($i = 0; $i < count($tplData['recenzenty']); $i++){
    $sezn_recenzentu = "<option value='".$tplData['recenzenty'][$i]['id_UZIVATEL']."'>".$tplData['recenzenty'][$i]['username']."</option>";
}
$res = '<div class="container mt-4" id="tables">
        <h1>Správa receptů</h1>
        <br>
        <table class="table table-sm table-bordered table-striped table-hover">
            <thead class="table-dark text-center">
            <tr>
                <td rowspan="2">Název receptů</td>
                <td rowspan="2">Autor</td>
                <td colspan="8">Recenze</td>
                <td rowspan="2">Rozhodnutí</td>
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
            <tbody class="table-dark text-center">';

for($i = 0; $i < count($tplData['obsah']); $i++) {
    $nazev = $tplData['obsah'][$i]['nazev'];
    $autor = $tplData['obsah'][$i]['id_UZIVATEL'];
    $id_pris = $tplData['obsah'][$i]['id_PRISPEVEK'];
    $zverej = $tplData['obsah'][$i]['rozhodnuti'];
    if(!$zverej) {
        $zver = '<td rowspan="' . (1 + (count($tplData['obsah'][$i]['recenze']))) . '">
                    <form method="post" action="" onsubmit="if(confirmAktiv(`udělat veřejným`)){this.submit();}else{ return false;}">
                        <input type="hidden" name="recept" value="' . $id_pris . '">
                        <button class="btn btn-warning" type="submit" name="action" value="zverejnit">Zveřejnit</button>
                    </form></td>';
    }else{
        $zver = '<td rowspan="' . (1 + (count($tplData['obsah'][$i]['recenze']))) . '">Zveřejněn</td>';
    }
    $res .= '<tr>
                <td rowspan="'.(1+(count($tplData['obsah'][$i]['recenze']))).'">'.$nazev.'</td>
                <td rowspan="'.(1+(count($tplData['obsah'][$i]['recenze']))).'">'.$autor.'</td>
                <td>
                    <form method="post" action="" >
                        <select name="prirad" class="form-control" >
                                        <option value>Zvolte recenzenta</option>'.
                                        $sezn_recenzentu.'
                        </select>
                </td>
                <td colspan="7">
                            <input type="hidden" name="recept" value="'.$id_pris.'">
                            <button class="btn btn-warning" type="submit" name="action" value="create_rec">Vytvořit recenze</button>
                        </form>
                </td>'.
                $zver.'
                </tr>';

    for($j = 0; $j < count($tplData['obsah'][$i]['recenze']); $j++) {
        $id_recen = $tplData['obsah'][$i]['recenze'][$j][0];
        $id_recept =  $recenzent = $tplData['obsah'][$i]['recenze'][$j][8];
        $recenzent = $tplData['obsah'][$i]['recenze'][$j]['id_UZIVATEL'];
        $orig = $tplData['obsah'][$i]['recenze'][$j][1];
        $tema = $tplData['obsah'][$i]['recenze'][$j][2];
        $tech = $tplData['obsah'][$i]['recenze'][$j][3];
        $jazyk = $tplData['obsah'][$i]['recenze'][$j][4];
        $dopor = $tplData['obsah'][$i]['recenze'][$j][5];
        $prumer = ($orig + $tema + $tech + $jazyk + $dopor)/5;
        $res .= '<tr>
                    <td>' . $recenzent . '</td>
                    <td>' . $orig . '</td>
                    <td>' . $tema . '</td>
                    <td>' . $tech . '</td>
                    <td>' . $jazyk . '</td>
                    <td>' . $dopor . '</td>
                    <td>' . $prumer . '</td>
                    <td>
                        <form method="post" action="" onsubmit="if(confirmAktiv(`smazat`)){this.submit();}else{ return false;}">
                            <input type="hidden" name="recept" value="'.$id_recept.'">
                            <input type="hidden" name="recenze_del" value="'.$id_recen.'">
                            <button class="btn btn-warning" type="submit" name="action" value="delete"><i class="fas fa-trash-alt"></i></button>
                        </form></td>
                </tr>';
    }
}

$res .= '</tbody></table></div><br><br>';
echo $res;
    $temp->getHTMLFooter();
?>