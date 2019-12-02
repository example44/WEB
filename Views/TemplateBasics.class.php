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
                <style>
                    nav { background-color:orange; padding:10px; }
                    nav a { margin: 0px 10px; }
                    footer { padding: 10px; background-color: lightgrey; text-align: center; }
                    .alert { padding: 10px; background-color: lightblue; font-weight: bold; margin-bottom: 20px; border-radius: 10px; }
                </style>
            </head>
            <body>
                <h1> <?php echo $pageTitle; ?></h1>

                <nav>
                    <?php
                        foreach (WEB_PAGES as $key => $p){
                            echo "<a href='index.php?page=$key'>$p[title]</a>";
                        }

                    ?>
                </nav>
                <br>
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