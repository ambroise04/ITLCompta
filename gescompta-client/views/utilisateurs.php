<!DOCTYPE html>
<html lang="fr">
<?php
    if(!isset($_SESSION['user']) && !empty($_SESSION['user'])){
        header ("location : login.php");
    }else{
        $_GET['_title'] = 'Utilisateurs - ITLCOMPTA';
        $_GET['_page'] = 'utilisateurs.php';

        include "../partials/head.php";
        require("../../gescompta-api/connexionBD.php");

        $query = "SELECT * FROM utilisateurs ORDER BY idUser DESC";
    
        $result = mysqli_query($bd, $query);
    }

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
            <span id="top-user"></span>
                <section class="wrapper">
                    <div class="row mt">
                        <div class="col-lg-12">
                            <div class="panel panel-default" id="reglement">                     
                                <div class="wrapper-head">
                                    <h3>LISTE DES UTILISATEURS</h3>
                                </div>
                                <div class="panel-body">
                                    <br>
                                    <table class="table table-bordered table-striped" id="userTable">
                                        <thead>
                                             <tr>
                                                <th width="9%"><center>Photo</center></th>
                                                <th width="7%"><center>Id</center></th>
                                                <th width="18%"><center>Nom</center></th>
                                                <th width="18%"><center>Prénom</center></th>
                                                <th width="18%"><center>Login</center></th>
                                                <th width="10%"><center>Etat</center></th>
                                                <th width="10%"><center>Modification</center></th>
                                                <th width="10%"><center>Suppression</center></th>
                                             </tr>
                                        </thead>    
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            <!-- AJOUT ET MODIFICATION D'UTILISATEUR -->
            <p id="ajout"></p>
            <section class="wrapper">
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="panel panel-default">                                    
                            <div class="wrapper-head">
                                <h3 id="title-new-user">NOUVEL UTILISATEUR</h3>
                            </div>
                            <div class="panel-body">
                                <br>
                                <form method="post" action="" id="formUser">
                                    <div class="form-group">
                                        <div class="in-title">
                                            Choisir le type d'utilisateur
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="row in-space">
                                                <div class="col-lg-offset-4 col-lg-4">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon1">Utilisateur</span>
                                                        <select name="typeEcrit" class="form-control" id="comboTypeUser">
                                                            <option value="1">Comptable</option>
                                                            <option value="2">Chef-comptable</option>
                                                            <option value="3">Administrateur</option>
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
                                                                <input type="text" class="form-control" aria-describedby="basic-addon1" minlength="2" required="required" id="nomUser">
                                                            </div>
                                                            <p class="hidden text-left" style="color: red">Champ mal renseigné! Veuillez entrer au moins 2 caractères</p>
                                                        </div>
                                                        <div class="col-lg-offset-4 col-lg-4">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">Prénom</span>
                                                                <input type="text" class="form-control" aria-describedby="basic-addon1" minlength="2" required="required" id="prenomUser">
                                                            </div>
                                                            <p class="hidden text-left" style="color: red">Champ mal renseigné! Veuillez entrer au moins 2 caractères</p>
                                                        </div>                    
                                                    </div>
                                                    <br>                 
                                                </div>
                                                <div class="row in-space">
                                                    <div class="row" id="physique">
                                                        <div class="col-lg-5">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">Photo de profil</span><input type="file" class="form-control" aria-describedby="basic-addon1" name="piecesJustificatives" id="photoUser">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-offset-2 col-lg-5">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">Email</span>
                                                                <input type="email" class="form-control" aria-describedby="basic-addon1" required="required" id="emailUser" minlength="5">
                                                            </div>
                                                            <p class="hidden text-left" style="color: red">Veuillez entrer une adresse e-mail valide</p>
                                                        </div>                    
                                                    </div>
                                                    <br>                 
                                                </div>                      
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="in-title">
                                            Paramètres d'authentification
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="row in-space">
                                                <div class="row in-space">
                                                    <div class="row">
                                                        <div class="col-lg-5">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">Login</span>
                                                                <input type="text" class="form-control" aria-describedby="basic-addon1" minlength="4" required="required" id="loginUser">
                                                            </div>
                                                            <p class="hidden text-left" style="color: red">Champ mal renseigné! Veuillez entrez au moins 4 caractères</p>
                                                        </div>
                                                        <div class="col-lg-offset-2 col-lg-5">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1">Mot de passe</span>
                                                                <input type="password" class="form-control" aria-describedby="basic-addon1" minlength="6" required="required" id="passeUser">
                                                            </div>
                                                            <p class="hidden text-left" style="color: red">Champ mal renseigné! Veuillez entrez au moins 6 caractères</p>
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
                                                    <button type="submit" class="btn btn-default form-control style-button" id="btnSoumUser">Soumettre</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>                                      
            </section><!-- wrapper -->
        </section><!--main content -->

        <?php
            include "../partials/footer.php";
        ?>

        <?php       
          include "../partials/scripts.php";
        ?>
        <script src="../assets/js/user/update.js" type="text/javascript"></script>
        <script src="../assets/js/user/etatUser.js" type="text/javascript"></script>
        <script src="../assets/js/user/delete.js" type="text/javascript"></script>
        <script src="../assets/js/user/add.js" type="text/javascript"></script>
    </section><!--container -->

</body>
</html>