<?php

/**
 * Trida vypisujici HTML hlavicku a paticku stranky.
 */
class TemplateBasics {

    /**
     *  Vrati vrsek stranky az po oblast, ve ktere se vypisuje obsah stranky.
     *  @param string $pageTitle    Nazev stranky.
     */
    public function getHTMLHeader(string $pageTitle, $menu) {
        global $tplData;
        ?>
        <!doctype html>
        <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
                <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
                <script src="javascript/scripts.js"></script>
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
                <link rel="stylesheet" href="css/styl.css">
                <title><?php echo $pageTitle; ?></title>
            </head>
            <body>
                <div id="main">
                    <nav class="navbar navbar-expand-lg navbar-dark " id="nav" >
                        <img src="img/logo2.jpg" width="150" height="60" alt="logo">
                            <?php
                                if(isset($_SESSION['current_user_id'])) {
                            ?>
                                    <form method="POST">
                                        <div id="odhlaseni">
                                            <span class="navbar-text" id="nav_text" >
                                                Ahoj, <span id="nikname"><?php echo $tplData['uzivatel']['username']?></span>
                                            </span>
                                            <input type="hidden" name="action" value="logout">
                                            <button type="submit" class="btn" id="btn_nav"  name="action" value="odhlaseni"><i class="fas fa-sign-out-alt"></i> Odhlásit</button>
                                        </div>
                                    </form>

                                    <?php
                                }
                                ?>
                    </nav>
                    <nav class="navbar navbar-expand-md navbar-dark " id="nav_mal"  >
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="collapsibleNavbar" >
                            <ul class="navbar-nav ">
                                <?php
                                    foreach ($menu as $key => $p){
                                        echo "<li class='nav_link'><a  href='index.php?page=$key'class='nav-link' id='nav_link' '>$p[title]</a></li>";
                                    }
                                    ?>
                            </ul>
                        </div>
                    </nav>
        <?php
        if(isset($GLOBALS['alert'])){
            echo '<div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>
               '.$GLOBALS["alert"].'
            </div>';
        }
    }

        /**
         *  Vrati paticku stranky.
         */
        public function getHTMLFooter(){
            ?>
            </div>
            <footer class="page-footer font-small cyan darken-3" id="footer" >
                <div class="container mt-4">

                        <div class="col-md-12 py-4" >
                            <div class="mb-5" >
                                <div class="form-group" id="skupina_znacku">
                                    <a class="fb-ic" data-toggle="tooltip" title="Facebook">
                                        <i class="fab fa-facebook-f fa-lg  mr-md-5 mr-3 fa-2x"> </i>
                                    </a>

                                    <a class="ins-ic"data-toggle="tooltip" title="Instagram">
                                        <i class="fab fa-instagram fa-lg  mr-md-5 mr-3 fa-2x"> </i>
                                    </a>
                                    <a class="gplus-ic"data-toggle="tooltip" title="Google plus">
                                        <i class="fab fa-google-plus-g fa-lg  mr-md-5 mr-3 fa-2x"> </i>
                                    </a>
                                    <a class="tw-ic" data-toggle="tooltip" title="Twitter">
                                        <i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                                    </a>

                                </div>
                            </div>
                        </div>

                </div>


                    <div class="footer-copyright py-3" "  >© 2019 Copyright: <span class="jmeno" ">Simonov Yan </span></div>
                </footer>
            </body>
         </html>
            <?php
    }

}
