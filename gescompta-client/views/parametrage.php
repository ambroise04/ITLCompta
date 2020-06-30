<!DOCTYPE html>
<html lang="fr">
    <?php
        $_GET['_title'] = 'Paramètrage - ITLCOMPTA';
        $_GET['_page'] = 'parametrage.php';
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
                        <h2 class="page-title">Paramètres</h2>
                        <h5 class="page-desc">Cette page vous permet de configurer un compte de votre comptabilité. <br>
                            La configuration de la TVA applicable dans votre région est également possible. <br>
                            Par ailleurs, vous pouvez modifier votre profil d'utilisateur</h5>
                    </div>
                    <hr>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <!-- Premiere section -->
                        <div class="panel panel-default mt">
                            <div class="panel-heading" role="tab" id="heading1" align="left">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    <h4 class="panel-title">
                                        Comptes
                                    </h4>
                                </a>
                            </div><br>
                            <div class="white-panel panel-collapse collapse" id="collapse1" role="tabpanel" aria-labelledby="heading1">
                                <div class="panel-body">
                                    <div class="row" style= "position: relative; left: 25px; top: -20px">
                                        <form id="formCompte">
                                            <div class="row" align="left">
                                                <h5>Vous pouvez choisir d'ajouter un compte manuellement ou d'insérer un fichier contenant les comptes dans un format .json.</h5>
                                            </div>
                                            <div class="row" align="left">
                                                <ul>
                                                    <li>
                                                        <input tabindex="1" type="radio" id="manuel" name="compte" value="manuel" checked>
                                                        <label for="manuel">Enregistrer un compte manuellement</span></label>
                                                    </li>
                                                    <li>
                                                        <input tabindex="2" type="radio" id="fichier" name="compte" value="fichier">
                                                        <label for="fichier">Charger un fichier .json</label>
                                                    </li>
                                                </ul>                      
                                            </div>
                                            <hr style="width: 95%; height: 5px;" align="left">
                                            <div class="form-group ml-30" id="partieManuel">
                                                <p><h3 align="left">Ajouter un compte manuellement</h3></p><br>
                                                <div class="row" style="width: 90%">
                                                    <div class="col-lg-4" style="position: relative;left: 60px;">
                                                        <div class="form-group">
                                                            <label for="num" hidden>Numéro du compte</label>
                                                            <input type="text" id="num" class="horizontal-input form-control" placeholder="Numéro" required="required" manuel>
                                                        </div>
                                                        <p class="hidden text-left" style="color: red">Veuillez saisir le numéro de compte.</p>
                                                    </div>
                                                    
                                                    <div class="col-lg-offset-1 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="newPass" hidden>Intitulé du compte</label>
                                                            <input type="text" id="libelle" class="horizontal-input form-control" placeholder="Libellé" required="required" manuel>
                                                        </div>
                                                        <p class="hidden text-left" style="color: red">Veuillez saisir l'intitulé du compte</p>
                                                    </div>                                                
                                                    
                                                    <div class="col-lg-offset-1 col-lg-2" align="center">
                                                        <button type="submit" id="btnAddCompte" class="btn btn-default form-control style-button" style="position: relative;right: 20px;">Ajouter</button>
                                                    </div>
                                                </div><br>
                                        
                                            </div>
                                            <div class="form-group ml-30" id="partieFichier">
                                                <p><h3 align="left">Charger un fichier json contenant les comptes</h3>
                                                <h5 align="left">Un fichier json est du type : {"numero": 57, "intitulé": "Caisse"}</h5>
                                                </p><br>

                                                <div class="row" style="width: 90%">
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <label for="fichier" hidden>Choix du fichier</label>
                                                            <input type="file" id="fichier" class="horizontal-input form-control" required="required">
                                                        </div>
                                                        <p class="hidden text-left" style="color: red">Veuillez choisir le fichier json.</p>
                                                    </div>
                                                    <div class="col-lg-offset-1 col-lg-3">
                                                        <button type="submit" id="loadFile" class="btn btn-default form-control style-button" style="position: relative;right: 20px;">Charger</button>
                                                    </div>                                              
                                                </div><br>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <!-- Deuxième section -->
                        <div class="panel panel-default mt">
                            <div class="panel-heading" role="tab" id="heading2" align="left">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    <h4 class="panel-title">
                                        Configuration de la TVA
                                    </h4>
                                </a>
                            </div>
                            <br>
                            <div id="collapse2" class="white-panel panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                                <div class="panel-body">
                                    <div class="row">
                                        <form>
                                            <div class="form-group">
                                                <div class="row" style= "position: relative; left: 25px; top: -20px">
                                                    <div class="col-lg-4">
                                                        <div class="form-group" align="left">
                                                            <span class="in-style">La TVA est &nbsp;: </span>&nbsp;&nbsp;
                                                            <input type="checkbox" data-toggle="toggle" data-width="100px"; data-height="30px" data-on="Activée" data-off="Désactivée" data-onstyle="info" data-offstyle="danger">
                                                        </div>
                                                    </div>
                                                     
                                                    <div class="col-lg-offset-1 col-lg-4" align="left">
                                                        <span class="in-style">Veuillez entrer la valeur de la TVA : &nbsp;
                                                            <input type="text" id="tva" class="horizontal-input form-control" placeholder="TVA" required="required" style="width: 300px;">
                                                        </span>
                                                    </div>                                  
                                                </div>
                                                
                                                <!-- <div class="row ml">
                                                    <div class="col-lg-3" align="center">
                                                        <button type="reset" class="btn btn-default form-control style-button" style="position: relative;right: 20px;">Annuler</button>
                                                    </div>
                                                    <div class="col-lg-offset-6 col-lg-3" align="center">
                                                        <button type="submit" id="btnChangePass" class="btn btn-default form-control style-button" style="position: relative;right: 20px;">Valider</button>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <!-- Troisième section -->
                        <!-- <div class="panel panel-default mt">
                            <div class="panel-heading" role="tab" id="heading3" align="left">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    <h4 class="panel-title">
                                        Profil utilisateur
                                    </h4>
                                </a>
                            </div><br>
                            <div id="collapse3" class="white-panel panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                                <div class="panel-body">
                                    <div class="row">
                                        <form id="formChangePass">
                                            <div class="form-group ml-30">
                                                <div class="row">
                                                    <div class="col-lg-9" align="left">
                                                        <h3>Comptes</h3>
                                                    </div>
                                                </div> <br>
                                                <div class="row">
                                                    <div class="col-lg-3" style="position: relative;left: 60px;">
                                                        <div class="form-group">
                                                            <label for="ancienPass" hidden>Ancien mot de passe</label>
                                                            <input type="password" id="ancienPass" class="horizontal-input form-control" placeholder="Ancien mot de passe"  minlength="6" required="required">
                                                        </div>
                                                        <p class="hidden text-left" style="color: red">Veuillez saisir votre ancien mot de passe</p>
                                                    </div>
                                                    
                                                    <div class="col-lg-offset-2 col-lg-3">
                                                        <div class="form-group">
                                                            <label for="newPass" hidden>Nouveau mot de passe</label>
                                                            <input type="password" id="newPass" class="horizontal-input form-control" placeholder="Nouveau mot de passe" minlength="6" required="required">
                                                        </div>
                                                        <p class="hidden text-left" style="color: red">Veuillez saisir votre nouveau mot de passe</p>
                                                    </div>

                                                    <div class="col-lg-3" align="left">
                                                        <div class="form-group">
                                                            <label for="confNewPass" hidden>Ancien mot de passe</label>
                                                            <input type="password" id="confNewPass" class="horizontal-input form-control" placeholder="Confirmation"  minlength="6" required="required">
                                                        </div>
                                                        <p class="hidden text-left" style="color: red">Veuillez confirmer votre nouveau mot de passe</p>
                                                    </div>                                                
                                                </div><br>
                                                <div class="row ml">
                                                    <div class="col-lg-3" align="center">
                                                        <button type="reset" class="btn btn-default form-control style-button" style="position: relative;right: 20px;">Annuler</button>
                                                    </div>
                                                    <div class="col-lg-offset-6 col-lg-3" align="center">
                                                        <button type="submit" id="btnChangePass" class="btn btn-default form-control style-button" style="position: relative;right: 20px;">Valider</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>
                    
                    <div class="small-space"></div>
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

        <script src="../assets/js/parametre/changePass.js" type="text/javascript"></script>
        <script src="../assets/js/notifications.js" type="text/javascript"></script>
        <script src="../assets/js/parametrage/compte/addCompte.js" type="text/javascript"></script>

    </body>
</html>