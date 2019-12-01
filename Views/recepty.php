<?php
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['recepty']['title']);
    $temp->getHTMLFooter();
?>
