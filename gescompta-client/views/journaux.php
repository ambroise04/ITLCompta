<!DOCTYPE html>
<html lang="fr">
    <?php
        $_GET['_title'] = 'Journal - ITLCOMPTA';
        $_GET['_page'] = 'journaux.php';
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
                        <h2>Journal comptable</h2>
                        <h5>Document comptable qui enregistre de façon chronologique toutes les opérations quotidiennes effectuées par le cabinet.</h5>
                    </div>
                    <div class="panel panel-default mt">
                        <div class="white-panel">
                            <div class="panel-body">
                                <div class="row">
                                    <form>
                                        <div class="form-group">
                                            <div class="col-lg-3">
                                                <h5 align="left">Quel journal voulez-vous afficher ?</h5>
                                                <select class="form-control horizontal-input" id="nomJrnl">
                                            
                                                </select> 
                                            </div>
                                            <div class="col-lg-1"></div>
                                            <div class="col-lg-3" align="center">               
                                                <h5 align="left">Sélectionnez la date de début</h5>
                                                <input type="date" id="dateDebutJrnl" class="horizontal-input form-control">
                                            </div>
                                            
                                            <div class="col-lg-3" align="center">
                                                <h5 align="left">Sélectionnez la date de fin</h5>
                                                <div class="form-group">
                                                    <input type="date" id="dateFinJrnl" class="horizontal-input form-control">
                                                </div>
                                            </div>                                                
                                            
                                            <div class="col-lg-2" align="right"><br>
                                                <button type="button" id="btnJrnl" class="btn btn-default form-control style-button">Afficher</button>
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
                                    <div class="col-lg-12">
                                        <table class="table table-bordered table-striped" id="tabJrnl">
                                            <caption></caption>
                                            <thead>
                                                 <tr>
                                                    <th width="5%"><center>Jour</center></th>
                                                    <th width="9%"><center>Référence</center></th>
                                                    <th width="12%"><center>N° Compte</center></th>
                                                    <th width="12%"><center>N° Externe</center></th>
                                                    <th width="30%"><center>Libellé écriture</center></th>
                                                    <th width="12%"><center>Date écriture</center></th>
                                                    <th width="10%"><center>Débit</center></th>
                                                    <th width="10%"><center>Crédit</center></th>
                                                 </tr>
                                            </thead>
                                            <tbody id="tbodyJrnl" style="color: #424a5d">
                                            </tbody>   
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-offset-4 col-lg-4">
                                        <button type="button" id="btnImprimerJrnl" class="btn btn-default form-control style-button"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimer</button>
                                    </div>
                                </div>
                            </div>    
                        </div>  
                    </div>
                    <div class="space"></div>
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
        <script src="../assets/js/liste/journal.js" type="text/javascript"></script>
        <script src="../assets/js/jQuery.print.js" type="text/javascript"></script>

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
