

<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['autorizace']['title']);
?>
<div class="container mt-4">
        <h1>Autorizace</h1>
            <form class="autorizace" method="post" action="">
                Email: <input type="email" class="form-control" name="email" id="emal" value="" placeholder="Napište email">
                <br><br>
                Heslo: <input type="password" class="form-control" name="heslo" id="heslo" value="" placeholder="Napište heslo">
                <br><br>
                <button class="btn btn-success" name="action" value="vstup" type="submit" >Vstup</button><br>
            </form>
</div>
<h2>Přihlášený uživatel</h2>

Odhlášení uživatele:
<form action="" method="POST">
    <input type="hidden" name="action" value="logout">
    <input type="submit" name="action" value="odhlaseni">
</form>
<?php
    $temp->getHTMLFooter();
?>



