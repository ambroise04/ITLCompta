<!DOCTYPE html>
<html lang="fr">
    <?php
        $_GET['_title'] = 'Règlements - ITLCOMPTA';
        $_GET['_page'] = 'reglement.php';
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
                        <h2>Liste des règlements d'un client</h2>
                        <h5>Cette page vous permet d'obtenir la liste des paiements effectués par un client sur un projet donné</h5>
                    </div>
                    <div class="panel panel-default mt">
                        <div class="white-panel">
                            <div class="panel-body">
                                <div class="row">
                                    <form>
                                        <div class="form-group">
                                            <div class="col-lg-4">
                                                <h5 align="left">Veuillez entrer le nom/dénomination ou le code du client.</h5>
                                                <input type="text" id="nomClt" class="horizontal-input form-control" placeholder="Nom ou Dénomination du client"> 
                                            </div>
                                            <div class="col-lg-4" align="center">
                                                <h5 align="left">Sélectionnez le projet dont vous voulez voir les règlements effectués</h5>
                                                <select class="form-control horizontal-input" id="listeDesProjets">
                                            
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <h5 align="left">Nombre de projets</h5>
                                                    <input type="text" class="form-control" style="width: 60px;" disabled="disabled" id="nbreProj">
                                                </div>
                                            </div>
                                            <div class="col-lg-2"><br>
                                                <button type="button" id="btnListeReg" class="btn btn-default form-control style-button">Afficher</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <div class="panel panel-default mt">    
                        <div class="white-panel">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <h5 align="left">COÛT DU PROJET</h5>
                                            <input type="text" class="form-control" style="width: 200px;" disabled="disabled" id="coutProj">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-bordered table-striped" id="tabListeRegClt">
                                            <caption></caption>
                                            <thead>
                                                 <tr>
                                                    <th width="20%"><center>Date</center></th>
                                                    <th width="35%"><center>Montant réglé (F CFA)</center></th>
                                                    <th width="35%"><center>Montant restant (F CFA)</center></th>
                                                    <th width="10%"><center>Soldé</center></th>
                                                 </tr>
                                            </thead>
                                            <tbody id="table-body" style="color: #424a5d">
                                            </tbody>   
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-offset-4 col-lg-4">
                                        <button type="button" id="btnImprimerReg" class="btn btn-default form-control style-button"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimer</button>
                                    </div>
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
        <script src="../assets/js/liste/reglementClient.js" type="text/javascript"></script>
        <script src="../assets/js/jQuery.print.js" type="text/javascript"></script>
        <script src="../assets/js/notifications.js" type="text/javascript"></script>

        <script>

            $(function() {
                var laSource = '../../gescompta-api/client/liste.php';
                $("#nomClt").autocomplete({
                    source : laSource
                });
            });

        </script>
    </body>
</html>
