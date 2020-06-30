<!DOCTYPE html>
<html lang="fr">
    <?php
        $_GET['_title'] = 'Profil - ITLCOMPTA';
        $_GET['_page'] = 'profil.php';
    ?>
    <?php
        include "../partials/head.php";
    ?>

    <body>

        <section id="container" >
        
            <?php
                include "../partials/header.php";
            ?>
          
            <?php
                include "../partials/menu.php";
            ?>
          
            <section id="main-content">
                <section class="wrapper">
                    <div class="topSpace">
                        <h2>Profil</h2>
                        <h5 style="color: #09bad6">
                            Editez votre profil d'utilisateur ...
                        </h5>
                    </div>

                    <div class="panel panel-default mt">
                        <div class="white-panel">
                            <div class="panel-body">
                                <div class="row">
                                    <form>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-4">               
                                                    <h5 align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date inférieure</h5>
                                                    <input type="date" id="dateDebutBal" class="horizontal-input form-control" style="position: relative;left: 20px;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">               
                                                    <h5 align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date inférieure</h5>
                                                    <input type="date" id="dateDebutBal" class="horizontal-input form-control" style="position: relative;left: 20px;">
                                                </div>
                                                
                                                <div class="col-lg-offset-1 col-lg-4" align="right">
                                                    <h5 align="left">Date supérieure</h5>
                                                    <div class="form-group">
                                                        <input type="date" id="dateFinBal" class="horizontal-input form-control">
                                                    </div>
                                                </div>                                                
                                                
                                                <div class="col-lg-offset-1 col-lg-2" align="left"><br>
                                                    <button type="button" id="btnBal" class="btn btn-default form-control style-button" style="position: relative;right: 20px;">Afficher</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>           	

        	    </section><!--/wrapper -->
            </section><!-- /MAIN CONTENT -->

            <!--main content end-->
            <?php
                include "../partials/footer.php";
            ?>
        </section>

        <?php
            include "../partials/scripts.php";
        ?>

        <script src="../assets/js/profil/profil.js" type="text/javascript"></script>
        <script src="../assets/js/notifications.js" type="text/javascript"></script>



    </body>
</html>