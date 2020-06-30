<!DOCTYPE html>
<html lang="fr">
    <?php
        $_GET['_title'] = 'Comptabilité - ITLCOMPTA';
        $_GET['_page'] = 'comptabilite.php';
    ?>
    <?php
        include "../partials/head.php";
    ?>

    <?php
        require("../../gescompta-api/connexionBD.php");
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
                <span id="top-compta"></span>
                <!-- Partie reglement -->
                <section class="wrapper">
                    <div class="row mt">
                        <div class="col-lg-12">
                            <div class="panel panel-default" id="reglement">                                    
                                <div class="wrapper-head">
                                    <h3>Règlement client</h3>
                                </div>
                                <div class="panel-body">
                                    <br>
                                    <form method="post" action="" id="formReglement">

                                        <!-- Partie cachée à afficher après sélection du client et projet -->

                                        <!-- Début infos sur l'état financier du projet -->
                                        <div class="form-group" hidden id="infoEtatReg">
                                            <div class="in-title">
                                                Etat de règlement du projet
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="row in-space">
                                                    <div class="col-lg-5">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Montant dû</span>
                                                            <input type="text" class="form-control" aria-describedby="basic-addon1" readonly id="montantDu1"><span class="input-group-addon" id="basic-addon1">F CFA</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-offset-2 col-lg-5">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Total des règlements</span>
                                                            <input type="text" class="form-control" aria-describedby="basic-addon1" readonly id="totalReglemt"><span class="input-group-addon" id="basic-addon1">F CFA</span>
                                                        </div>
                                                    </div>                                           
                                                </div>
                                                <div class="row in-space">
                                                    <div class="col-lg-offset-3 col-lg-5">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Reste à payer</span>
                                                            <input type="text" class="form-control" aria-describedby="basic-addon1" readonly id="resteAPayer"><span class="input-group-addon" id="basic-addon1">F CFA</span>
                                                        </div>
                                                    </div>                                           
                                                </div>                                       
                                            </div>
                                            
                                        </div>
                                        <!-- Fin infos sur l'état financier du projet -->

                                        <!-- Début infos financières à afficher à la fin du règlement -->
                                        <div class="form-group" id="etatReglemt" hidden>
                                            <div class="in-title">
                                                Informations financières du projet
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="row in-space">
                                                    <div class="col-lg-offset-3 col-lg-5">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">COUT DU PROJET</span>
                                                            <input type="text" class="form-control" aria-describedby="basic-addon1" readonly id="montantProjet"><span class="input-group-addon" id="basic-addon1">F CFA</span>
                                                        </div>
                                                    </div>                                           
                                                </div>                                       
                                                <div class="row in-space">
                                                    <div class="col-lg-5">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">ANCIEN SOLDE</span>
                                                            <input type="text" class="form-control" aria-describedby="basic-addon1" readonly id="ancienSolde"><span class="input-group-addon" id="basic-addon1">F CFA</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-offset-2 col-lg-5">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">NOUVEAU SOLDE</span>
                                                            <input type="text" class="form-control" aria-describedby="basic-addon1" readonly id="newSolde"><span class="input-group-addon" id="basic-addon1">F CFA</span>
                                                        </div>
                                                    </div>                                           
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="row in-space">
                                                    <div class="col-lg-offset-4 col-lg-4">
                                                        <button type="button" class="btn btn-default style-button form-control" id="bntAutreReg">Effectuer un autre règlement</button>    
                                                    </div>
                                                </div>

                                                <div class="row in-space">
                                                    <table class="table table-bordered table-striped" id="reglmtClientTable">
                                                        <caption></caption>
                                                        <thead>
                                                             <tr>
                                                                <th width="20%"><center>Date</center></th>
                                                                <th width="35%"><center>Montant réglé (F CFA)</center></th>
                                                                <th width="35%"><center>Montant restant (F CFA)</center></th>
                                                                <th width="10%"><center>Soldé</center></th>
                                                             </tr>
                                                        </thead>    
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fin infos financières à afficher à la fin du règlement -->

                                        <!-- Partie cachée à afficher après sélection du client et projet -->

                                        <div class="form-group toHide">
                                            <div class="in-title">
                                                Client - Projet
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="row in-space">
                                                    <div class="col-lg-5">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Nom du client</span>
                                                            <input type="text" class="form-control listeClient" aria-describedby="basic-addon1" id="nomClientReg" autocomplete="off" required="required">
                                                        </div>
                                                        <p class="hidden text-left" style="color: red">Veuillez renseigner le nom du client</p>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <div class="input-group">
                                                            <button type="button" class="btn btn-default form-control"><a title="Cliquez pour ajouter un client" data-reveal-id="myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></button>
                                                        </div>
                                                    </div>
                                                     <div class="col-lg-offset-1 col-lg-5">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Projet</span>
                                                            <select class="form-control" aria-describedby="basic-addon1" name="typeRegl" id="listeProjetClient">
                                                                
                                                            </select>
                                                            
                                                        </div>
                                                    </div>                                         
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Deuxième partie -->
                                        <div class="form-group toHide">
                                            <div class="in-title">
                                                Détails
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="row in-space">
                                                    <div class="col-lg-5">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Type de règlement</span>
                                                            <select class="form-control" aria-describedby="basic-addon1" name="typeRegl" id="typeReg">
                                                                <?php                                        
                                                                    
                                                                    $query = 'SELECT * FROM typereglements';
                                                                        
                                                                    $donnees = mysqli_query($bd,$query);
                                                                    $num = 1;

                                                                    while ($result = mysqli_fetch_array($donnees)){
                                                        
                                                                      echo '<option name="op'.$num.'">'.$result["libelleTypeReglemt"].'</option>';
                                                                      $num++;

                                                                    }
                                                                ?>
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-offset-3 col-lg-4">
                                                         <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Date</span>
                                                            <input type="date" class="form-control" aria-describedby="basic-addon1" required="required" id="dateReg">
                                                        </div> 
                                                        <p class="hidden text-left" style="color: red">Veuillez renseigner la date</p>      
                                                    </div>                                            
                                                </div>

                                                <div class="row in-space">
                                                    <div class="col-lg-offset-2 col-lg-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Entrez l'écriture relative au règlement</span>
                                                            <select  class="form-control" aria-describedby="basic-addon1" name="ecritRegl" id="ecritReg">
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="input-group">
                                                            <button type="button" class="btn btn-default form-control"><a title="Cliquez pour ajouter une écriture"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a></button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row in-space">
                                                    <div class="col-lg-5">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Montant</span>
                                                            <input type="text" class="form-control" aria-describedby="basic-addon1" required="required" id="montantReg"><span class="input-group-addon" id="basic-addon1">F CFA</span>
                                                        </div>
                                                        <p class="hidden text-left" style="color: red">Veuillez entrer le montant du règlement</p>
                                                    </div>
                                                    <div class="col-lg-offset-3 col-lg-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Libellé</span>
                                                            <input type="text" class="form-control" aria-describedby="basic-addon1" required="required" id="commentReg">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row in-space">
                                                <div class="form-group">
                                                    <div class="col-lg-4">
                                                        <button type="reset" class="btn btn-default style-button form-control">Annuler</button>
                                                    </div>
                                                    <div class="col-lg-offset-4 col-lg-4">
                                                        <button type="submit" class="btn btn-default form-control style-button" id="btnSoumReg">Soumettre</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Section pour les Charges -->
                            <div class="space">
                                
                            </div>
                            <div class="space">
                                
                            </div>
                            <div class="panel panel-default" id="charge">                                    
                                <div class="wrapper-head">
                                    <h3>Enregistrement d'une dépense</h3>
                                </div>
                                <div class="panel-body">
                                    <br>
                                    <form method="post" action="" id="formDepense">
                                        <div class="form-group">                                            
                                            <div class="panel panel-default">
                                                <div class="row in-space">
                                                    <div class="col-lg-offset-4 col-lg-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Fournisseur</span>
                                                            <input type="text" class="form-control listeFrs" aria-describedby="basic-addon1" id="frsDep" required="required">
                                                        </div>
                                                        <p class="hidden text-left" style="color: red">Veuillez entrer le nom du fournisseur</p>
                                                    </div>                    
                                                </div>
                                                <div class="row in-space">
                                                    <div class="col-lg-5">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Montant</span>
                                                            <input type="text" class="form-control" aria-describedby="basic-addon1" id="montantDep" required="required"><span class="input-group-addon" id="basic-addon1">F CFA</span>
                                                        </div>
                                                        <p class="hidden text-left" style="color: red">Veuillez entrer le montant de la charge</p>
                                                    </div>                                          
                                                    <div class="col-lg-offset-2 col-lg-4" right>
                                                        <div class="input-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">Date</span>
                                                                <input type="date" class="form-control" aria-describedby="basic-addon1" id="dateDep" required="required">
                                                            </div> 
                                                            <p class="hidden text-left" style="color: red">Veuillez renseigner la date</p>
                                                        </div>
                                                    </div>                    
                                                </div>
                                                <div class="row in-space">
                                                    <div class="col-lg-5"><br>
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Ecriture relative à la charge</span>
                                                            <select  class="form-control" aria-describedby="basic-addon1" id="ecritDep">
                                                            </select>
                                                        </div>
                                                    </div>                     
                                                    <div class="col-lg-offset-2 col-lg-5">
                                                        <div class="input-group">
                                                            <label for="descCharge">Description de la charge</label>
                                                            <textarea name="commentaire" class="form-control" id="descDep"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row in-space">
                                                <div class="form-group">
                                                    <div class="col-lg-4">
                                                        <button type="reset" class="btn btn-default style-button form-control">Annuler</button>
                                                    </div>
                                                    <div class="col-lg-offset-4 col-lg-4">
                                                        <button type="submit" class="btn btn-default form-control style-button" id="btnSoumDepense">Soumettre</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="space">
                                
                            </div>
                            <!-- Fin section Charge -->
                        </div>
                    </div>
                </div>

              	<!-- Fenetre modale -->
               
                    <div class="reveal-modal panel panel-default" id="myModal">                                    
                        <div class="wrapper-head">
                            <h3>AJOUT D'UN CLIENT</h3>
                        </div>
                        <div class="panel-body">
                            <br>
                            <form method="post" action="">
                                <div class="form-group">
                                    <div class="in-title">
                                        Choisir le type de Client
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="row in-space">
                                            <div class="col-lg-offset-4 col-lg-5">
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1">Personne</span>
                                                    <select name="typeEcrit" class="form-control" id="comboTypeClient2">
                                                        <option value="charge">physique</option>
                                                        <option value="reglement">morale</option>
                                                    </select>
                                                </div>
                                            </div>                                              
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="in-title">
                                        Identité
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="row in-space">
                                            <div class="row in-space">
                                                <div class="row" id="physique2">
                                                    <div class="col-lg-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Nom</span>
                                                            <input type="text" class="form-control" aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-offset-4 col-lg-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Prénom</span>
                                                            <input type="text" class="form-control" aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>                    
                                                </div>
                                                <br>
                                                <div class="row" id="morale2" hidden="hidden">            
                                                    <div class="col-lg-offset-3 col-lg-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Dénomination</span>
                                                            <input type="text" class="form-control" aria-describedby="basic-addon1">        
                                                        </div>              
                                                    </div>
                                                </div>                                      
                                            </div>                      
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="in-title">
                                        Autres informations
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="row in-space">
                                            <div class="row in-space">
                                                <div class="row">
                                                    <div class="col-lg-5">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Numéro de téléphone</span>
                                                            <input type="text" class="form-control" aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-offset-2 col-lg-5">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Email</span>
                                                            <input type="text" class="form-control" aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>                    
                                                </div>
                                                <br>
                                                <div class="row">            
                                                    <div class="col-lg-offset-3 col-lg-6">
                                                        <div class="input-group">
                                                            <label for="comment">Adresse complète</label>
                                                            <textarea name="commentaire" class="form-control" id="comment"></textarea>
                                                        </div>              
                                                    </div>
                                                </div>                                      
                                            </div>                      
                                        </div>
                                    </div>
                                    <div class="row in-space">
                                        <div class="form-group">
                                            <div class="col-lg-4">
                                                <button type="reset" class="btn btn-default style-button form-control">Annuler</button>
                                            </div>
                                            <div class="col-lg-offset-4 col-lg-4">
                                                <button type="submit" class="btn btn-default form-control style-button">Soumettre</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                
                <!-- Fin fenetre modale -->

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

        <script src="../assets/js/operation/addReglement.js" type="text/javascript"></script>
        <script src="../assets/js/operation/addDepense.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                var laSource = '../../gescompta-api/client/liste.php';
                $(".listeClient").autocomplete({
                    source : laSource
                });
            });

            $(function() {
                var laSource = '../../gescompta-api/fournisseur/liste.php';
                $(".listeFrs").autocomplete({
                    source : laSource
                });
            });
        </script>
    </body>
</html>
