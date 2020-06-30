<!DOCTYPE html>
<html lang="fr">
    <?php
        $_GET['_title'] = 'Fournisseurs - ITLCompta';
        $_GET['_page'] = 'fournisseur.php';
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
                <span id="top-fournisseur"></span>
                <div class="small-space"></div>
                <section class="wrapper">
                    <div class="topSpace">
                        <h2>Ajouter un fournisseur</h2>
                        <h5></h5>
                    </div>

                    <div class="panel panel-default mt">
                        <div class="white-panel">
                            <div class="panel-body">
                                <div class="row">
                                    <form id="formFrs">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-offset-1 col-lg-4">
                                                    <h5 align="left">Entrez le nom complet du fournisseur.</h5>
                                                    <input type="text" id="nomFrs" class="horizontal-input form-control" placeholder="Nom" required="required"> 
                                                </div>
                                                <div class="col-lg-offset-2 col-lg-4" align="right">
                                                    <h5 align="left">Numéro de téléphone du fournisseur.</h5>
                                                    <input type="text" id="numFrs" class="horizontal-input form-control" placeholder="Tél." required="required">
                                                </div>
                                            </div>
                                            <div class="row mt">
                                                <div class="col-lg-offset-1 col-lg-4">
                                                    <div class="form-group">
                                                        <h5 align="left">Saisissez l'adresse complète du fournisseur.</h5>
                                                        <textarea id="adresseFrs" class="horizontal-input form-control" align="left">Adresse
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-offset-2 col-lg-4" align="right">
                                                    <h5 align="left">Entrez l'adresse e-mail du fournisseur.</h5>
                                                    <input type="email" id="emailFrs" class="horizontal-input form-control" placeholder="E-mail" required="required">
                                                </div>
                                            </div>
                                            <div class="row mt">
                                                <div class="form-group">
                                                    <div class="col-lg-offset-1 col-lg-4">
                                                        <button type="reset" class="btn btn-default style-button form-control">Annuler</button>
                                                    </div>
                                                    <div class="col-lg-offset-2 col-lg-4">
                                                        <button type="submit" class="btn btn-default form-control style-button" id="btnAddFrs">Ajouter</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>    
                        </div>
                    </div>

                    <div class="space">
                        <span id="listeFrs"></span>
                    </div>
                    <div>
                        <h2>Liste des fournisseurs</h2>
                    </div>
                    <div class="panel panel-default mt">
                        <div class="white-panel">
                            <div class="panel-body">
                                <div class="row">
                                <table class="table table-bordered table-striped" id="tableFrs" style="color: #424a5d">
                                        <thead>
                                             <tr>
                                                <th width="30%"><center>Nom</center></th>
                                                <th width="10%"><center>Code</center></th>
                                                <th width="15%"><center>Num. Tél.</center></th>
                                                <th width="20%"><center>Email</center></th>
                                                <th width="20%"><center>Adresse</center></th>
                                             </tr>
                                        </thead>    
                                    </table>
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

        <script src="../assets/js/fournisseur/addFrs.js" type="text/javascript"></script>
    </body>
</html>
