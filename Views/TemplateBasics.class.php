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
            <body onload="labelUser(<?php echo $tplData['uzivatel']['role'] ?>)">
                <div id="main">
                    <nav class="navbar navbar-expand-lg navbar-dark " id="nav" >
                        <img src="img/logo2.jpg" width="150" height="60" alt="logo">
                            <?php
                                if(isset($_SESSION['current_user_id'])) {
                            ?>
                                    <form action="" method="POST" onsubmit="if(confirmAktiv(`vyjít`)){this.submit();}else{ return false;}">
                                      <div class="container" id="odhlaseni">
                                          <span class="navbar-text">
                                                Ahoj, <span id="labelUs" style="color: #f8931f"><?php echo $tplData['uzivatel']['username'] ?></span>
                                            </span>
                                            <button type="submit" class="btn" name="action" value="odhlaseni"><i class="fas fa-sign-out-alt"></i> Odhlásit</button>
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
                                        echo "<li class='nav-item'><a  href='index.php?page=$key'class='nav-link' style='color: aliceblue '>$p[title]</a></li>";
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
            <!-- Footer -->
            <footer class="page-footer font-small cyan darken-3" id="footer" >

                <!-- Footer Elements -->
                <div class="container">

                    <!-- Grid row-->
                    <div class="row">
                        <!-- Grid column -->
                        <div class="col-md-10 py-5" >
                            <div class="mb-5 flex-center" >
                                <div class="form-group ">
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
                </div>

                    <div class="footer-copyright py-3" style=" background-color: black"  >© 2019 Copyright: <span style="color: #f8931f ">Simonov Yan </span></div>
                </footer>
            <script>
                function labelUser(id_role) {
                    if (id_role == 0) {
                        document.getElementById("labelUs").innerHTML = "";
                        return;
                    } else {
                        const xmlhttp = getXmlHttp();
                        xmlhttp.onreadystatechange = function () {
                            if(this.readyState == 4 && this.status == 200){
                                document.getElementById("labelUs").innerHTML += " ("+this.responseText+")";
                            }
                        };
                        xmlhttp.open("GET", "ajax-server.php?id_role="+id_role, true);
                        xmlhttp.send();
                    }
                }
            </script>
            </body>
         </html>
            <?php
    }

}
