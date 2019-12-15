<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['recepty']['title'], $tplData['menu']);

$res = '<div class="container mt-4" id="tables">
        <h1>Recepty naších uživatelů</h1>
        <br>
        <table class="table table-sm table-bordered table-striped table-hover">
             <thead class="table-dark text-center ">
                <tr>
                <th>Název receptu</th>
                <th>Autor</th>
                <th>Obsah receptu</th>
                <th>Stáhnout</th>
                </tr>
            </thead >
            <tbody class="table-dark text-center">';
for($i = 0; $i < count($tplData['obsah']); $i++) {
    $nazev = $tplData['obsah'][$i]['nazev'];
    $autor = $tplData['obsah'][$i]['id_UZIVATEL'];
    $obsah = $tplData['obsah'][$i]['obsah'];
    $id = $tplData['obsah'][$i]['id_PRISPEVEK'];
    $res .= '<tr class="position-relative">
                <td>'.$nazev.'</td>
                <td>'.$autor.'</td>
                <td class="text-center">
                    <button onclick="chan('.$i.')" data-toggle="collapse" type="button" class="btn btn-primary" data-target="#collap'.$i.'">Zobrazit obsah</button>
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