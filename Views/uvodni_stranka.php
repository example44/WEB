<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['uvodni']['title']);
    if(isset($_SESSION['current_user_id'])) {
        ?>
        <h2>Přihlášený uživatel</h2>

        Odhlášení uživatele:
        <form action="" method="POST">
            <input type="hidden" name="action" value="logout">
            <input type="submit" name="action" value="odhlaseni">
        </form>
        <?php
    }
    $temp->getHTMLFooter();
?>
