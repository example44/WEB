<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['receptyKPosouz']['title'], $tplData['menu']);

$res = '<table class="table table-sm table-bordered table-striped table-hover">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Název</th>
                        <th>Průměr</th>
                        <th>Akce</th>
                    </tr>
                </thead>
                <tbody class="table-dark text-center">';
for($i = 0; $i < count($tplData['obsah']); $i++) {
    $nazev = $tplData['obsah'][$i]['nazev'];
    $orig = $tplData['obsah'][$i][6];
    $tema = $tplData['obsah'][$i][7];
    $tech = $tplData['obsah'][$i][8];
    $jazyk = $tplData['obsah'][$i][9];
    $dopor = $tplData['obsah'][$i][10];
    $prumer = ($orig + $tema + $tech + $jazyk + $dopor)/5.0;
    $id = $tplData['obsah'][$i]['id_PRISPEVEK'];
    $res .= '<tr class="position-relative">
                <td>'.$nazev.'</td>
                <th>'.$prumer.'</th>
                <td class="text-center">
                    <form method="post" action="">
                        <input type="hidden" name="recept_del" value="'.$id.'">
                        <button class="btn btn-warning" type="submit" name="action" value="delete">Smazat</button>
                    </form>
                </td>
            </tr>';
}
$res .= '</tbody></table>';
echo $res;

    $temp->getHTMLFooter();
?>