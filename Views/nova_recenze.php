<?php
global $tplData;
require_once "TemplateBasics.class.php";
$temp = new TemplateBasics();
$temp->getHTMLHeader(WEB_PAGES['novaRecenze']['title'], $tplData['menu']);
?>
<div class="container mt-4" id="hlavni">
  <div class="row-padded">
    <div class="form-group">
      <form class="nova_recenze" method="post" id="forms" action="" enctype="multipart/form-data">
          <h1>Vytvoření nové recenze</h1>
          <br><br>
          <label>Název recenze:<br> <input type="text" class="form-control" name="recenze_naz" id="recenze_naz" value="<?php echo $tplData['recenze_naz']['value'];?>" placeholder="Zadejte název recenze" required></label>
          <span class="error"> <?php echo $tplData['recenze_naz']['error'];?></span>
          <br>
          <br>
          <label>Název počitačové hry: <br><textarea name="recenze_ob" rows="4" cols="30" id="recenze_ob" placeholder="Název hry" required><?php echo $tplData['obsah']['value'];?></textarea></label>
          <span class="error"> <?php echo $tplData['obsah']['error'];?></span>
          <br>
          <br>
          <label>PDF Soubor:<br><input type="file" name="soubor" accept="application/pdf" id="soubor"></label>
          <br><br>
          <button class="btn btn-success" name="action" value="create_recenze" type="submit">Odeslat</button><br>
          <br><br>
      </form>
    </div>
  </div>
</div>
<?php
$temp->getHTMLFooter();
?>
