<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['recepty']['title'], $tplData['menu']);
?>
<div class="container mt-4" id="forms">
    <h1>Recepty naších uživatelů</h1>
</div>
<?php

$res = '<div class="container mt-4 " id="forms"></div>
        <br>
        <table class="table table-sm table-bordered container mt-4">
             <thead class=" text-center " style="background-color: black; color:bisque">
             <tr>
                <th>Název receptu</th>
                <th>Autor</th>
                <th>Obsah receptu</th>
                <th>Stáhnout</th>
                </tr>
            </thead >
            <tbody class=" text-center" style="background-color: #1D1F20; color: bisque">';
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
                    <button onclick="chan('.$i.')" data-toggle="collapse" type="button" class="btn btn-primary" data-target="#collap'.$i.'">Zobrazit obsah</button>
                        <div id="collap'.$i.'" class="collapse">
                            '.$obsah.'
                        </div>
                </td>
                <td><a href="soubory/'.$soubor.'" download><i class="fas fa-download"></i></a></td>
            </tr>';
}
$res .= '</tbody></table></div>';
echo $res;
$temp->getHTMLFooter();
?>
