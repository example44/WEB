<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['recepty']['title'], $tplData['menu']);

$res = '<table class="table table-sm table-bordered table-striped table-hover">
            <thead class="table-dark text-center">
                <tr>
                <th>Název</th>
                <th>Autor</th>
                <th>Akce</th>
                </tr>
            </thead>
            <tbody>';
for($i = 0; $i < count($tplData['obsah']); $i++) {
    $nazev = $tplData['obsah'][$i]['nazev'];
    $autor = $tplData['obsah'][$i]['UZIVATEL_id_UZIVATEL'];
    $obsah = $tplData['obsah'][$i]['obsah'];
    $id = $tplData['obsah'][$i]['id_PRISPEVEK'];
    $res .= '<tr class="position-relative">
                <td>'.$nazev.'</td>
                <td>'.$autor.'</td>
                <td class="text-center">
                    <form method="post" action="">
                    <input type="hidden" name="recept_zob" value="$id">
                    <button class="btn btn-warning" onclick="alert(`$obsah`)">Zobrazit obsah</button>
                    </form>
                </td>
            </tr>';
}
$res .= '</tbody></table>';
echo $res;

    $temp->getHTMLFooter();
?>
