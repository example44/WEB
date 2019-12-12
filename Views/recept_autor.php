<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['recepAutor']['title'], $tplData['menu']);

    $res = '<table class="table table-sm table-bordered table-striped table-hover">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Název</th>
                        <th>Akce</th>
                    </tr>
                </thead>
                <tbody>';
for($i = 0; $i < count($tplData['obsah']); $i++) {
    $nazev = $tplData['obsah'][$i]['nazev'];
    $id = $tplData['obsah'][$i]['id_PRISPEVEK'];
    $res .= '<tr class="position-relative">
                <td>'.$nazev.'</td>
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