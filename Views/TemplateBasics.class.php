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
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
                      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
                <link rel="stylesheet" href="../css/styl.css">
                <title><?php echo $pageTitle; ?></title>

            </head>
            <body>

                <nav class="navbar navbar-expand-lg navbar-dark " style="background-color:black " >
                    <a href="#" class="navbar-brand">
                        <img src="logo2.jpg" width="70" height="30" alt="logo">
                    </a>
                </nav>

                <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #1D1F20">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                        <span class="icon-bar"></span>

                    </button>
                        <div class="collapse navbar-collapse" id="navbar-main">
                            <ul class="navbar-nav ">
                                <?php
                                    foreach (WEB_PAGES as $key => $p){
                                        echo "<li class=\"active\"><a  href='index.php?page=$key'class='nav-link' style='color: aliceblue'>$p[title]</a></li>";
                                    }
                                    ?>


                            </ul>

                        </div>
                    </nav>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!--        <h1> --><?php //echo $pageTitle; ?><!--</h1>-->

        <?php
        }

        /**
         *  Vrati paticku stranky.
         */
        public function getHTMLFooter(){
            ?>
                    <footer class="page-footer footer-dark" style="background-color: black">
                        <div class="footer-copyright text-center py-3"style="color: aliceblue">© 2019 Copyright:
                        </div>
                    </footer>
                </body>
            </html>
            <?php
    }
        
}

