<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader($tplData['title']);
    $temp->getHTMLFooter();
?>