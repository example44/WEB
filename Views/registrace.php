
<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['registrace']['title'],$tplData['menu']);
?>
<div class="container mt-4" id="hlavni">
        <h1>Registrace</h1>
            <form class="prihlaseni" method="post" action="">
                Username: <input type="text" class="form-control" name="name"  id="name" value="" placeholder="Napište username">
                <?php echo $tplData['username']['error'];?>
                <br><br>
                Email: <input type="email" class="form-control" name="email" id="emal" value="" placeholder="Napište email">
                <?php echo $tplData['email']['error'];?>
                <br><br>
                Heslo: <input type="password" class="form-control" name="heslo" id="heslo" value="" placeholder="Napište heslo">
                <?php echo $tplData['heslo']['error'];?>
                <br><br>
                Heslo znovu: <input type="password" class="form-control" name="heslo_znovu" id="heslo_znovu" value="" placeholder="Zopakujte heslo">
                <?php echo $tplData['heslo_znovu']['error'];?>
                <br><br>
                Typ uživatele:<br>
                    <select name="role" class="form-control" >
                        <option value="">     </option>
                        <option value="3">Autor</option>
                        <option value="2">Recenzent</option>
                    </select>
                <?php echo $tplData['role']['error'];?>
                    <br><br>
                <button class="btn btn-success" name="action" value="registrace" type="submit" >Zaregistrovat</button><br>
            </form>
</div>
<?php

    $temp->getHTMLFooter();
?>
