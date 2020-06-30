<?php

    $_GET['_title'] = 'Authentification';
    $_GET['_page'] = 'login.php';
    include "../partials/head.php";
?>

<body>
    <div id="login-page">
        <div class="container">
            <form class="form-login" id="formulaire" method="post">
                <h2 class="form-login-heading">Authentification<br>ITLCompta</h2>
                <div class="login-wrap">
                    <div>
                        <p class="hidden text-left" id="parLoginError" style="color: red">Données incorrectes.</p>
                        <input type="text" class="form-control" name="user" placeholder="Nom d'utilisateur" id="login" minlength="4" required="required" autocomplete="off">
                        <p class="hidden text-left" style="color: red" check>Champ mal renseigné! Veuillez entrer au moins 4 caractères</p>
                    </div>
                    <br>
                    <div>
                        <input type="password" class="form-control" name="passe" placeholder="Mot de passe" id="passe" minlength="6" required="required">
                        <p class="hidden text-left" style="color: red" check>Champ mal renseigné! Veuillez entrer au moins 6 caractères</p>
                    </div>
                    <label class="checkbox">
                            <span class="pull-right">
                                <a data-toggle="modal" href="login.php#myModal">Mot de passe oublié ?</a>
                            </span>
                    </label>
                    <div class="form control">
                        <input type="checkbox" id="memoire"><label for="memoire">Mémoriser mon mot de passe</label>
                    </div>
                    <button class="btn btn-theme btn-block" type="submit" id="valider"><i class="fa fa-lock"></i>VALIDER</button>
                    <hr>
                    <div class="registration">
                        Vous n'avez pas encore un compte ?<br/>
                        <p style="color: #2a6496">
                            Consultez un Administrateur!
                        </p>
                        <p id="paraImg" class="hidden">
                            <img src="../assets/img/loader.gif" alt="Chargement en cours"/>
                        </p>
                    </div>
    
                </div>
            </form>
                <!-- Modal -->
                <form class="form-login" id="formForgotten" action="">
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Mot de passe oublié ?</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Entrez votre adresse e-mail pour retrouver votre Mot de passe.</p>
                                    <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix" id="forgottenPass" required="required">
                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler</button>
                                    <button class="btn btn-theme" type="button">Soumettre</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal -->
                </form>
        </div>
    </div>

    <script src="../modules/js/jquery.js"></script>
    <script src="../modules/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../modules/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("../modules/img/login-bg.jpg", {speed: 500});
    </script>
    
    <script src="../assets/js/login.js"></script>
    

</body>