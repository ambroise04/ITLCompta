<!DOCTYPE html>
<html lang="fr">
    <?php
        $_GET['_title'] = 'Exercices - ITLCompta';
        $_GET['_page'] = 'exercice.php';
    ?>
    <?php
        include "../partials/head.php";
    ?>

    <body>

        <section id="container">
        
            <?php
                include "../partials/header.php";
            ?>
          
            <?php
                include "../partials/menu.php";
            ?>
          
            <section id="main-content">
                <span id="top-exercice"></span>
                <section class="wrapper">
                    <div class="topSpace">
                        <div class="small-space"></div>
                        <h2>Ouverture d'exercice</h2>
                        <h5>L'exercice comptable désigne la période de temps limitée au cours de laquelle le <br>cabinet mentionne tous les faits économiques qui le concernent.</h5>
                    </div>

                    <div class="panel panel-default mt">
                        <div class="white-panel">
                            <div class="panel-body">
                                <div class="row">
                                    <form id="formExo">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-offset-1 col-lg-4">
                                                    <div class="input-group">
                                                        <h5 align="left">Entrez l'année de l'exercice à ouvrir. Exemple : 2017.</h5>
                                                        <input type="text" id="anneeExo" class="horizontal-input form-control" placeholder="Année" required="required">
                                                    </div>
                                                    <p class="hidden text-left" style="color: red">Veuillez entrer l'année de l'exercice.</p> 
                                                </div>
                                                <div class="col-lg-offset-2 col-lg-4" align="right">
                                                    <div class="input-group">
                                                        <h5 align="left">Entrez le libellé de l'exercice. Exemple : Exercice 2017.</h5>
                                                        <input type="text" id="libelleExo" class="horizontal-input form-control" placeholder="Libellé" required="required">
                                                    </div>
                                                    <p class="hidden text-left" style="color: red">Veuillez entrer le libellé de l'exercice.</p>
                                                </div>
                                            </div>
                                            <div class="row mt">
                                                <div class="form-group">
                                                    <div class="col-lg-offset-1 col-lg-4">
                                                        <button type="reset" class="btn btn-default style-button form-control">Annuler</button>
                                                    </div>
                                                    <div class="col-lg-offset-2 col-lg-4">
                                                        <button type="submit" class="btn btn-default form-control style-button" id="btnAddExo">Ajouter</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>    
                        </div>
                    </div>

                    <div class="small-space"></div>
                    <div class="space"></div>

                    <div id="cloture" class="small-space"></div>

                    <div>
                        <h2>Liste des Exercices</h2>
                    </div>
                    <div class="panel panel-default mt">
                        <div class="white-panel">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-offset-1 col-lg-10" style="color: #424a5d;">
                                        <table class="table table-bordered table-striped" id="tableExo" style="border-color: #424a5d;">
                                            <thead>
                                                 <tr>
                                                    <th width="25%"><center>Année</center></th>
                                                    <th width="50%"><center>Libellé</center></th>
                                                    <th width="25%"><center>Action</center></th>
                                                 </tr>
                                            </thead>    
                                        </table>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <div class="small-space"></div>

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

        <script src="../assets/js/exercice/addExo.js" type="text/javascript"></script>
        <script src="../assets/js/exercice/clotureExo.js" type="text/javascript"></script>
    </body>
</html>
