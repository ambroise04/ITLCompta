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
                <section class="wrapper">
                    <div class="row mt">
                    <div class="col-lg-10">
                        <div class="panel panel-default">                                    
                            <div class="wrapper-head">
                                <h3>CHARGE</h3>
                            </div>
                            <div class="panel-body">
                                <br>
                                <form method="post" action="">
                                    <div class="form-group">
                                        <!-- <div class="in-title">
                                            Information relative au client
                                        </div> -->
                                        <div class="panel panel-default">
                                            <div class="row in-space">
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon1">Compte</span>
                                                        <input type="text" class="form-control" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="input-group">
                                                        <button type="button" class="btn btn-default form-control"><a title="Plan comptable SYSCOHADA"><span class="glyphicon glyphicon-book" aria-hidden="true"></span></a></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-offset-1 col-lg-5">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon1">Fournisseur</span>
                                                        <input type="text" class="form-control" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>                    
                                            </div>
                                            <div class="row in-space">
                                                <div class="col-lg-5">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon1">Montant</span>
                                                        <input type="text" class="form-control" aria-describedby="basic-addon1"><span class="input-group-addon" id="basic-addon1">F CFA</span>
                                                    </div>
                                                </div>                                          
                                                <div class="col-lg-offset-2 col-lg-4" right>
                                                    <div class="input-group">
                                                        <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon1">Date</span>
                                                        <input type="date" class="form-control" aria-describedby="basic-addon1">
                                                    </div> 
                                                    </div>
                                                </div>                    
                                            </div>
                                            <div class="row in-space">
                                                <div class="col-lg-offset-3 col-lg-5">
                                                    <div class="input-group">
                                                        <label for="comment">Description de la charge</label>
                                                        <textarea name="commentaire" class="form-control" id="descCharge"></textarea>
                                                    </div>
                                                </div>                    
                                            </div>
                                        </div>
                                    </div>
                                </form>
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

    </body>
</html>
