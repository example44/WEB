<?php
global $tplData;
require_once "TemplateBasics.class.php";
$temp = new TemplateBasics();
$temp->getHTMLHeader(WEB_PAGES['novyRecept']['title'], $tplData['menu']);
?>
<div class="container mt-4" id="hlavni">
  <div class="row-padded">
    <div class="form-group text-center">
      <form class="novy_recept" method="post" id="forms" action="" enctype="multipart/form-data">
          <h1>Vytvoření nového receptu</h1>
          <br><br>
          <label>Název receptu:<br> <input type="text" class="form-control" name="recept_naz" id="recept_naz" value="<?php echo $tplData['recept_naz']['value'];?>" placeholder="Zadejte název receptu" required></label>
          <span class="error"> <?php echo $tplData['recept_naz']['error'];?></span>
          <br>
          <br>
          <label>Popis receptu: <br><textarea name="recept_ob" rows="4" cols="30" id="recept_ob" placeholder="Popiště svůj recept" required><?php echo $tplData['obsah']['value'];?></textarea></label>
          <span class="error"> <?php echo $tplData['obsah']['error'];?></span>
          <br>
          <br>
          <label>PDF Soubor:<br><input type="file" name="soubor" accept="application/pdf" id="soubor"></label>
          <br><br>
          <button class="btn btn-success" name="action" value="create_recept" type="submit">Odeslat</button><br>
      </form>
    </div>
  </div>
</div>
<?php
$temp->getHTMLFooter();
?>
