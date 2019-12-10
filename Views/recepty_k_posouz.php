<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['receptyKPosouz']['title'], $tplData['menu']);
    $temp->getHTMLFooter();
?>