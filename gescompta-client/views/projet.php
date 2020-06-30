<!DOCTYPE html>
<html lang="fr">
    <?php
        $_GET['_title'] = 'Projets - ITLCOMPTA';
        $_GET['_page'] = 'projet.php';
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
                <span id="top-projet"></span>
                <section class="wrapper">
              	     <div class="row mt">
                        <div class="col-lg-12">
                            <div class="panel panel-default">                     
                                <div class="wrapper-head">
                                    <h3>LISTE DES PROJETS</h3>
                                </div>
                                <div class="panel-body">
                                    <br>
                                    <table class="table table-bordered table-striped" id="tableProjet">
                                        <thead>
                                             <tr>
                                                <th width="25%">Libellé</th>
                                                <th width="%15">Montant (F CFA)</th>
                                                <th width="20%">Client</th>
                                                <th width="15%">Date d'ouverture</th>
                                                <th width="13%">Date de fin</th>
                                                <th width="12%">Livré</th>
                                             </tr>
                                        </thead>    
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="very-small-space"></div>
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

    </body>
</html>
