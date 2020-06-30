<!DOCTYPE html>
<html lang="fr">
    <?php
        $_GET['_title'] = 'Règlement - ITLCOMPTA';
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
                <span id="top-client"></span>
                <section class="wrapper">
              	     <div class="row mt">
                        <div class="col-lg-12">
                            <div class="panel panel-default">                                    
                                <div class="wrapper-head">
                                    <h3>Enregistrement d'un client</h3>
                                </div>
                                <div class="panel-body">
                                    <br>
                                    <form method="post" action="" id="formClient">
                                        <div class="form-group">
                                            <div class="in-title">
                                                Choisir le type de Client
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="row in-space">
                                                    <div class="col-lg-offset-4 col-lg-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Personne</span>
                                                            <select name="typeEcrit" class="form-control" id="comboTypeClient">
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
                                                        <div class="row" id="physique">
                                                            <div class="col-lg-4">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1">Nom</span>
                                                                    <input type="text" class="form-control" aria-describedby="basic-addon1" id="nomClient">
                                                                </div>
                                                                <p class="hidden text-left" style="color: red">Veuillez entrer le nom du client</p>
                                                            </div>
                                                            <div class="col-lg-offset-4 col-lg-4">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1">Prénom</span>
                                                                    <input type="text" class="form-control" aria-describedby="basic-addon1" id="prenomClient">
                                                                </div>
                                                                <p class="hidden text-left" style="color: red">Veuillez entrer le prénom du client</p>
                                                            </div>                    
                                                        </div>
                                                        <br>
                                                        <div class="row" id="morale" hidden="hidden">            
                                                            <div class="col-lg-offset-3 col-lg-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1">Dénomination</span>
                                                                    <input type="text" class="form-control" aria-describedby="basic-addon1" id="denoClient">        
                                                                </div>
                                                                <p class="hidden text-left" style="color: red">Veuillez entrer la dénomination du client</p>              
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
                                                                    <input type="text" class="form-control" aria-describedby="basic-addon1" required="required" id="numClient">
                                                                </div>
                                                                <p class="hidden text-left" style="color: red">Veuillez entrer le numéro de téléphone du client</p>
                                                            </div>
                                                            <div class="col-lg-offset-2 col-lg-5">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1">Email</span>
                                                                    <input type="text" class="form-control" aria-describedby="basic-addon1" required="required" id="emailClient">
                                                                </div>
                                                                <p class="hidden text-left" style="color: red">Veuillez entrer l'email du client</p>
                                                            </div>                    
                                                        </div>
                                                        <br>
                                                        <div class="row">            
                                                            <div class="col-lg-offset-3 col-lg-6">
                                                                <div class="input-group">
                                                                    <label for="adresseClient">Adresse complète</label>
                                                                    <textarea name="client" class="form-control" id="adresseClient"></textarea>
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
                                                        <button type="submit" class="btn btn-default form-control style-button" id="btnSoumClient">Soumettre</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
        	    </section><!--/wrapper -->
                <div class="space">
                    <span  id="listeP"></span>
                </div>
                <section class="wrapper">
                    <div class="row mt">
                        <div class="col-lg-12">
                            <div class="panel panel-default">                     
                                <div class="wrapper-head">
                                    <h3>LISTE DES CLIENTS - PERSONNES PHYSIQUES</h3>
                                </div>
                                <div class="panel-body">
                                    <br>
                                    <table class="table table-bordered table-striped" id="clientPhysique">
                                        <thead>
                                             <tr>
                                                <th width="14%">Nom</th>
                                                <th width="16%">Prénom</th>
                                                <th width="4%">Code</th>
                                                <th width="12%">Num. Tél.</th>
                                                <th width="18%">Email</th>
                                                <th width="18%">Adresse</th>
                                                <!-- <th width="9%">Modification</th>
                                                <th width="9%">Suppression</th> -->
                                             </tr>
                                        </thead>    
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            <div class="space">
            </div>
            <section class="wrapper">
                    <div class="row mt" id="listeM">
                        <div class="col-lg-12">
                            <div class="panel panel-default">                     
                                <div class="wrapper-head">
                                    <h3>LISTE DES CLIENTS - PERSONNES MORALES</h3>
                                </div>
                                <div class="panel-body">
                                    <br>
                                    <table class="table table-bordered table-striped" id="clientMoral">
                                        <thead>
                                             <tr>
                                                <th width="25%">Dénomination</th>
                                                <th width="9%">Code</th>
                                                <th width="12%">Num. Tél.</th>
                                                <th width="18%">Email</th>
                                                <th width="18%">Adresse</th>
                                                <!-- <th width="9%">Modification</th>
                                                <th width="9%">Suppression</th> -->
                                             </tr>
                                        </thead>    
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            <div class="last-bottom-space">
            </div>

            </section><!-- /MAIN CONTENT -->

            <!--main content end-->
            <?php
                include "../partials/footer.php";
            ?>

            <?php
                include "../partials/scripts.php";
            ?>

            <script src="../assets/js/client/addClient.js" type="text/javascript"></script>
        </section><!--container -->

    </body>
</html>
