<!DOCTYPE html>
<html lang="fr">
    <?php
        $_GET['_title'] = 'Journal - ITLCOMPTA';
        $_GET['_page'] = 'journal.php';
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
                <span id="top-journal"></span>
                <br>
                <section class="wrapper">
              	    <div class="panel panel-default listeEnCours" id="listeJ">     

                        <div class="wrapper-head">
                            <h3>JOURNAUX EN COURS</h3>
                        </div>
                        <div class="panel-body">
                            <br>
                            <div class="row">
                                <div class="col-lg-offset-2 col-lg-4">
                                    <button type="button" class="btn btn-primary tousJournaux" style="margin-bottom: 10px; background-color: #424a5d;">Afficher tous les journaux</button>
                                </div>
                                <div class="col-lg-offset-2 col-lg-4">
                                    <button type="button" class="btn btn-primary newJournal" style="margin-bottom: 10px; background-color: #424a5d;">Nouveau Journal</button>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped" id="tableJournal">
                                <thead>
                                     <tr>
                                        <th width="10%"><center>Code</center></th>
                                        <th width="36%"><center>Libellé</center></th>
                                        <th width="20%"><center>Date début</center></th>
                                        <th width="20%"><center>Date fin</center></th>
                                        <th width="14%"><center>Action</center></th>
                                     </tr>
                                </thead>    
                            </table>
                        </div>
                    </div>

                    <!-- Tous les journaux -->
                    <div class="space">
                            
                    </div>
                    <div class="space" id="listeComplete">
                        
                    </div>

                    <div class="panel panel-default">                         
                        <div class="wrapper-head">
                            <h3>TOUS LES JOURNAUX</h3>
                        </div>
                        <div class="panel-body">
                            <br>
                            <div class="row">
                                <div class="col-lg-offset-2 col-lg-4">
                                    <button type="button" class="btn btn-primary haut" style="margin-bottom: 10px; background-color: #424a5d;">Afficher les cours en cours</button>
                                </div>
                                <div class="col-lg-offset-2 col-lg-4">
                                    <button type="button" class="btn btn-primary newJournal" style="margin-bottom: 10px; background-color: #424a5d;">Nouveau Journal</button>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped" id="allJournal">
                                <thead>
                                     <tr>
                                        <th width="10%"><center>Code</center></th>
                                        <th width="36%"><center>Libellé</center></th>
                                        <th width="20%"><center>Date début</center></th>
                                        <th width="20%"><center>Date fin</center></th>
                                        <th width="14%"><center>Action</center></th>
                                     </tr>
                                </thead>    
                            </table>
                        </div>
                    </div>

                    <!-- Nouveau journal -->
                    <div class="space">
                            
                    </div>
                    <div class="space" id="ajout">
                            
                    </div>
                    <div class="panel panel-default" id="addSection">                         
                        <div class="wrapper-head">
                            <h3>NOUVEAU JOURNAL</h3>
                        </div>
                        <div class="panel-body">
                            <br>
                            <form method="post" action="" id="formJournal">
                                <div class="form-group">
                                    <div class="panel panel-default">
                                        <div class="row in-space">
                                            <div class="col-lg-5">
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1">Libellé du journal</span>
                                                    <input type="text" class="form-control" aria-describedby="basic-addon1" required="required" id="libelleJ">
                                                </div>
                                                <p class="hidden text-left" style="color: red">Veuillez renseigner ce champ</p>
                                            </div>
                                            
                                            <div class="col-lg-offset-2 col-lg-5">
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1">Code du journal</span>
                                                    <input type="text" class="form-control" aria-describedby="basic-addon1" required="required" id="codeJ">
                                                </div>
                                                <p class="hidden text-left" style="color: red">Veuillez renseigner le code du journal</p>
                                            </div>                    
                                        </div>
                                        <div class="row in-space">
                                            <div class="col-lg-5"  align="right">
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1">Date début</span>
                                                    <input type="date" class="form-control" aria-describedby="basic-addon1" required="required" id="dateDebutJ">
                                                </div>
                                                <p class="hidden text-left" style="color: red">Veuillez renseigner la date de début de journal</p>
                                            </div>                                          
                                            <div class="col-lg-offset-2 col-lg-5" right>
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1">Date fin</span>
                                                    <input type="date" class="form-control" aria-describedby="basic-addon1" required="required" id="dateFinJ">
                                                </div>
                                                <p class="hidden text-left" style="color: red">Veuillez renseigner la date de fin de journal</p>
                                            </div>                    
                                        </div>
                                        <div class="row in-space">
                                            <div class="col-lg-offset-4 col-lg-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1">Exercice</span>
                                                    <input type="text" class="form-control complete" aria-describedby="basic-addon1" required="required" id="exoJ">
                                                </div>
                                                <p class="hidden text-left" style="color: red">Veuillez saisir l'exercice</p>
                                            </div>                    
                                        </div>
                                    </div>
                                    <div class="row in-space">
                                        <div class="form-group">
                                            <div class="col-lg-4">
                                                <button type="reset" class="btn btn-default style-button form-control">Annuler</button>
                                            </div>
                                            <div class="col-lg-offset-4 col-lg-4">
                                                <button type="submit" class="btn btn-default form-control style-button" id="btnAddJournal">Soumettre</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <br>
                    <div class="panel panel-default">
                        <div class="row in-space">
                            <div class="col-lg-offset-2 col-lg-4">
                                <button type="button" class="btn btn-primary haut" style="margin-bottom: 10px; background-color: #424a5d;">Journaux en cours</button>
                            </div>
                            <div class="col-lg-offset-2 col-lg-4">
                                <button type="button" class="btn btn-primary tousJournaux" style="margin-bottom: 10px; background-color: #424a5d;">Tous les journaux</button>
                            </div>
                        </div>
                    </div>

                    <div class="space">
                            
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

        <script src="../assets/js/journal/cloture.js" type="text/javascript"></script>
        <script src="../assets/js/journal/scrollToAdd.js" type="text/javascript"></script>
        <script src="../assets/js/journal/addJournal.js" type="text/javascript"></script>

        <script>

        $(function() {
            var laSource = '../../gescompta-api/exercice/liste.php';
            
            $(".complete").autocomplete({
                source : laSource
            });
        });
    </script>

    </body>
</html>
