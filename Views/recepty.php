<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['recepty']['title'], $tplData['menu']);

$res = '<table class="table table-sm table-bordered table-striped table-hover container mt-4" id="tables">
             <thead class="table-dark text-center ">
                <tr>
                <th>Název</th>
                <th>Autor</th>
                <th>Akce</th>
                </tr>
            </thead>
            <tbody>';
for($i = 0; $i < count($tplData['obsah']); $i++) {
    $nazev = $tplData['obsah'][$i]['nazev'];
    $autor = $tplData['obsah'][$i]['id_UZIVATEL'];
    $obsah = $tplData['obsah'][$i]['obsah'];
    $id = $tplData['obsah'][$i]['id_PRISPEVEK'];
    $res .= '<tr class="position-relative">
                <td>'.$nazev.'</td>
                <td>'.$autor.'</td>
                <td class="text-center">
                    <button data-toggle="collapse"type="button" class="btn btn-primary" data-target="#demo" >Zobrazit obsah</button>
                        <div id="demo" class="collapse">
                            '.$obsah.'
                        </div>

                </td>
            </tr>';
}
$res .= '</tbody></table>';
echo $res;

    $temp->getHTMLFooter();
