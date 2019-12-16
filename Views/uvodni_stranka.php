<?php
    global $tplData;
    require_once "TemplateBasics.class.php";
    $temp = new TemplateBasics();
    $temp->getHTMLHeader(WEB_PAGES['uvodni']['title'], $tplData['menu']);
?>
    <div class="container mt-4" id="forms">
        <h1>Vitáme Vás na portalu Cookhub</h1>
    </div>
    <div id="carouselExampleIndicators" class="carousel slide container mt-4" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner"id="carousel" >
            <div class="carousel-item active">
                <img class="d-block w-100" src="img/jidlo1.jpg"  alt="prvni" >
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/jidlo2.jpg" alt="druhy">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/jidlo3.jpg" alt="treti">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    </div>
    <div class="container mt-4" id="forms">

    </div>
    <div class="container mt-4" id="text">
        <h1>O portálu</h1>
        <?php echo $tplData['obsah']; ?>
    </div>
    <br><br>

<?php
    $temp->getHTMLFooter();


