<?php

/**
 * Trida vypisujici HTML hlavicku a paticku stranky.
 */
class TemplateBasics {

    /**
     *  Vrati vrsek stranky az po oblast, ve ktere se vypisuje obsah stranky.
     *  @param string $pageTitle    Nazev stranky.
     */
    public function getHTMLHeader(string $pageTitle) {
        ?>

        <!doctype html>
        <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
                <link rel="stylesheet" href="../../css/styl.css">
                <title><?php echo $pageTitle; ?></title>

            </head>
            <body>
                <nav class="navbar navbar-expand-lg navbar-dark  " style="background-color: black" >
                    <div class = "collapse navbar-collapse" id="navigace">
                        <a href="#" class="navbar-brand">
                            <img src="logo2.jpg" width="70" height="30" alt="logo">
                        </a>
                        <ul class = "navbar-nav mr-auto">
                            <li class = "nav-item active">
                                <?php
                                    foreach (WEB_PAGES as $key => $p){
                                        echo "<a href='index.php?page=$key'>$p[title]</a>";
                                    }
                                    ?>
                            </li>
                        </ul>

                    </div>
                </nav>
        <h1> <?php echo $pageTitle; ?></h1>

        <?php
        }

        /**
         *  Vrati paticku stranky.
         */
        public function getHTMLFooter(){
            ?>
                    <br>
                    <footer>Cvičení z KIV/WEB</footer>

            </body>
        </html>

        <?php
    }
        
}

?>