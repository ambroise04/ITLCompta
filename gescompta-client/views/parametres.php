<!DOCTYPE html>
<html lang="fr">
    <?php
        $_GET['_title'] = 'Paramètres - ITLCOMPTA';
        $_GET['_page'] = 'parametres.php';
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
                        <h2>Changez votre mot de passe</h2>
                        <h5>Le changement périodique de votre mot de passe est une recommandation du cabinet. <br>
                            Si vous oubliez votre mot de passe, veuillez consulter l'administrateur.</h5>
                    </div>

                    <div class="panel panel-default mt">
                        <div class="white-panel">
                            <div class="panel-body">
                                <div class="row">
                                    <form id="formChangePass">
                                        <div class="form-group ml-30">
                                            <div class="row">
                                                <div class="col-lg-9" align="left">
                                                    <h3>Nom d'utilisateur : </h3>
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

        <script src="../assets/js/parametre/changePass.js" type="text/javascript"></script>
        <script src="../assets/js/notifications.js" type="text/javascript"></script>

    </body>
</html>