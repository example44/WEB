<?php
global $tplData;
require_once "TemplateBasics.class.php";
$temp = new TemplateBasics();
$temp->getHTMLHeader(WEB_PAGES['spravaUziv']['title'], $tplData['menu']);
?>
    <div class="container mt-4" id="forms">
        <h1>Správa uživatelů</h1>
    </div>;
<?php
$res = '<div class="container mt-4" id="tables">
        <br>
        <table class="table table-sm table-bordered table-striped ">
            <thead class=" text-center" style="background-color: black; color:bisque">
            <tr>
                <th>Jméno</th>
                <th>Email</th>
                <th>Status</th>
                <th>Role</th>
                <th>Akce</th>
            </tr>
            </thead>
            <tbody class=" text-center" style="background-color: #1D1F20; color: bisque">';
for($i = 0; $i < count($tplData['users']); $i++) {
    $id_user = $tplData['users'][$i]['id_UZIVATEL'];
    $jmeno = $tplData['users'][$i]['username'];
    $email = $tplData['users'][$i]['email'];
    $status = $tplData['users'][$i]['active'];
    $id_role = $tplData['users'][$i]['id_ROLE'];
    $sezn_roli = "";
    for ($j = 0; $j < count($tplData['vse_role']); $j++) {
        if ($tplData['vse_role'][$j]['id_ROLE'] == $id_role) {
            $sezn_roli .= "<option value='" . $tplData['vse_role'][$j]['id_ROLE'] . "' selected>" . $tplData['vse_role'][$j]['nazev'] . "</option>";
        }else{
            $sezn_roli .= "<option value='" . $tplData['vse_role'][$j]['id_ROLE'] . "'>" . $tplData['vse_role'][$j]['nazev'] . "</option>";
        }
    }
    if($status) {
        $zmen_st = '<td>
                    <form method="post" action="" onsubmit="if(confirmAktiv(`zablokovat`)){this.submit();}else{ return false;}">
                        <input type="hidden" name="id_user" value="'.$id_user.'">
                        <input type="hidden" name="status" value="'.$status.'">
                        <button class="btn" type="submit" name="action" value="blok">Zablokovat</button>
                    </form>
                    <form method="post" action="" onsubmit="if(confirmAktiv(`smazat`)){this.submit();}else{ return false;}">
                            <input type="hidden" name="user_del" value="'.$id_user .'">
                            <button class="btn" type="submit" name="action" value="delete"><i class="fas fa-trash-alt"></i></button>
                        </form></td>
                    </td>';
    }else{
        $zmen_st = '<td>
                    <form method="post" action="" onsubmit="if(confirmAktiv(`odblokovat`)){this.submit();}else{ return false;}">
                        <input type="hidden" name="id_user" value="'.$id_user.'">
                        <input type="hidden" name="status" value="'.$status.'">
                        <button class="btn" type="submit" name="action" value="blok">Odblokovat</button>
                    </form>
                    <form method="post" action="" onsubmit="if(confirmAktiv(`smazat`)){this.submit();}else{ return false;}">
                            <input type="hidden" name="user_del" value="'.$id_user.'"> 
                            <button class="btn" type="submit" name="action" value="delete"><i class="fas fa-trash-alt"></i></button>
                        </form></td>
                    </td>';
    }
    if($status){
        $status = "ACTIVNÍ";
    }else{
        $status = "BLOKOVANÝ";
    }
    $res .= '<tr>
            <td>'.$jmeno.'</td>
            <td>'.$email.'</td>
            <td>'.$status.'</td>
            <td>
                <form method="post" action="" >
                        <select name="nova_role" class="form-control" >
                                        <option value>Zvolte role</option>'.
                                        $sezn_roli.'
                        </select>
                         <input type="hidden" name="user_up" value="'.$id_user.'">
                         <button class="btn" type="submit" name="action" value="save"><i class="fas fa-save"></i></button>
                 </form>
            </td>
            '.$zmen_st.'
            </tr>';
}

$res .= '</tbody></table></div><br><br>';
echo $res;
$temp->getHTMLFooter();
?>