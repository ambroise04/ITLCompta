<!DOCTYPE html>
<html lang="fr">
    <?php
        $_GET['_title'] = 'Balance - ITLCOMPTA';
        $_GET['_page'] = 'balance.php';
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
                        <h2>Balance</h2>
                        <h5 style="color: #09bad6">La balance comptable est un état d'une période, établi à partir de la liste de tous les <br> comptes du grand-livre du cabinet (qu'ils soient de bilan ou de gestion) et regroupant <br>tous les totaux (ou masses) en débit et crédit de ces comptes et par différence tous les <br>soldes débiteurs et créditeurs.</h5>
                    </div>

                    <div class="panel panel-default mt">
                        <div class="white-panel">
                            <div class="panel-body">
                                <div class="row">
                                    <form>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-9">
                                                    <h4>Choisissez les dates limites des opérations comptables enregistrées à afficher dans la balance.</h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">               
                                                    <h5 align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date inférieure</h5>
                                                    <input type="date" id="dateDebutBal" class="horizontal-input form-control" style="position: relative;left: 20px;">
                                                </div>
                                                
                                                <div class="col-lg-offset-1 col-lg-4" align="right">
                                                    <h5 align="left">Date supérieure</h5>
                                                    <div class="form-group">
                                                        <input type="date" id="dateFinBal" class="horizontal-input form-control">
                                                    </div>
                                                </div>                                                
                                                
                                                <div class="col-lg-offset-1 col-lg-2" align="left"><br>
                                                    <button type="button" id="btnBal" class="btn btn-default form-control style-button" style="position: relative;right: 20px;">Afficher</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default mt">
                        <div class="white-panel">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-bordered table-striped" id="tabBal">
                                            <caption></caption>
                                            <thead>
                                                <tr height="10%">    
                                                    <td rowspan="2" width="20%"><br><center>Comptes particuliers</center></td>
                                                    <td colspan="2" width="30%"><center>Total</center></td>
                                                    <td colspan="2" width="30%"><center>Solde</center></td>
                                                </tr>
                                                <tr>
                                                    <td>Débit</td>
                                                    <td>Crédit</td>
                                                    <td>Débit</td>
                                                    <td>Crédit</td>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyBal" style="color: #424a5d">
                                            </tbody>   
                                        </table>                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-offset-4 col-lg-4">
                                        <button type="button" id="btnImprimerBal" class="btn btn-default form-control style-button"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimer</button>
                                    </div>
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

        <script src="../assets/js/liste/balance.js" type="text/javascript"></script>

    </body>
</html>