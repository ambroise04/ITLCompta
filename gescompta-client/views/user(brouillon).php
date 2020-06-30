<div class="panel panel-default" id="reglement">                     
                            <div class="wrapper-head">
                                <h3>NOUVEL UTILISATEUR</h3>
                            </div>
                            <div class="panel-body">
                                <br>                    
                                <form method="post" id="formUser" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <!-- <label for="nom">Nom</label> -->
                                        <input type="text" class="horizontal-input form-control" id="nom" placeholder="Nom">
                                        <p hidden="hidden" id="name">Veuillez renseigner le champs ci-dessus</p>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="prenom">Prénom</label> -->
                                            <input type="text" class="horizontal-input form-control" id="prenom" placeholder="Prénom">
                                             <p hidden="hidden" id="prename">Veuillez renseigner le champs ci-dessus</p>
                                    </div>    
                                    <div class="form-group">
                                        <!-- <label for="login">Nom d'utilisateur</label> -->
                                        <input type="text" class="horizontal-input form-control" id="login" placeholder="Nom d'utilisateur">
                                        <p hidden="hidden" id="log">Veuillez renseigner le champs ci-dessus</p>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="pass">Mot de passe</label> -->
                                        <input type="password" class="horizontal-input form-control" id="pass" placeholder="Mot de passe">
                                        <p hidden="hidden" id="motdepasse">Veuillez renseigner le champs ci-dessus</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="typeUser">Type d'utilisateur</label>
                                        <select type="text" class="horizontal-input form-control" id="typeuser">
                                            <?php                                                      $query = 'SELECT * FROM typeusers';
                                                
                                                $donnees = mysqli_query($bd,$query);

                                                $num = 1;

                                                while ($result = mysqli_fetch_array($donnees)){
                                                    
                                                    echo '<option name="op'.$num.'">'.$result["libelleTypeUser"].'</option>';
                                                    $num++;

                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="image">Photo</label> -->
                                        <input type="file" name="user_image" class="none-border-input form-control" id="user_image">
                                        <span id="user_uploaded_image"></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <button type="reset" class="btn btn-primary form-control" align="left">Annuler</button>    
                                        </div>                                   
                                        <div class="col-lg-offset-6 col-lg-3">
                                            <button type="submit" class="btn btn-primary form-control" align="right">Ajouter</button>
                                        </div>                                    
                                    </div>                                           
                                </form> 
                            </div>
                        </div>