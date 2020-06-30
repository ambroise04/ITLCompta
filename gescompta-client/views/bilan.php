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
                        <h2>Statistique des mouvements financiers</h2>
                        <h5 style="color: #09bad6">
                            Il s'agit du rapport entre les dépenses effectuées par le cabinet <br>
                            et les entrées (règlements des clients). Ceci permet d'avoir un aperçu <br>
                            sur la santé du cabinet.
                        </h5>
                    </div>

                    <div class="panel panel-default mt">
                        <div class="white-panel">
                            <div class="panel-body">
                                <form>
                                    <div class="row" style= "position: relative; left: 25px; top: -20px">
                                        <div class="row" align="left">
                                            <h5>Choisissez entre la statistique globale et la statistique périodique. <br>
                                            La statistique globale prendra en compte tous les mouvements de l'exercice en cours.<br> La statistique périodique prend en compte les mouvements de la période délimitée. 
                                            </h5>
                                        </div>
                                        <div class="row" align="left">
                                            <ul>
                                                <li>
                                                    <input tabindex="1" type="radio" id="global" name="bilan" value="global" checked>
                                                    <label for="global">Statistique globale</span></label>
                                                </li>
                                                <li>
                                                    <input tabindex="2" type="radio" id="periodique" name="bilan" value="periodique">
                                                    <label for="periodique">Statistique périodique</label>
                                                </li>
                                            </ul>                      
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="panel panel-default mt" id="rowBilanGlobal" style="box-shadow: 2px 2px 2px silver">
                                            <div class="white-panel">
                                                <div class="panel-body">
                                                    <div class="row" id="bilanGlo" style= "position: relative; left: 25px; top: -20px">
                                                        <div class="row" align="left">
                                                            <h3 style="position: relative;left: 20px">Statistique globale</h3>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6" align="right">
                                                                <h3 id="legGain" align="left" style="color: #0abad6; position: relative;left: 100px;"></h3>
                                                                <h3 id="legReg" align="left" style="color: #424a5d; position: relative;left: 100px;"></h3>
                                                                    <canvas id="statBilan" height="300" width="400" style="background-color: #e2e2e2"></canvas>
                                                            </div>
                                                            <div class="col-lg-6" style="position: relative;right: 40px">
                                                                <div class="large-space"></div>
                                                                <h3>Le bilan est : <span id="paraComment"></span></h3>
                                                                <h3 id="result"></h3>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default mt" id="rowBilanPeriod" style="box-shadow: 2px 2px 2px silver">
                                            <div class="white-panel">
                                                <div class="panel-body">
                                                    <div class="row" style= "position: relative; left: 25px; top: -20px">
                                                        <div class="row" align="left">
                                                            <h3>Statistique périodique</h3>
                                                        </div>
                                                        <div class="row" align="left" style="width: 95%">
                                                            <div class="col-lg-4">               
                                                                <h5 align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date inférieure</h5>
                                                                <input type="date" id="dateDebutBil" class="horizontal-input form-control" style="position: relative;left: 20px;">
                                                            </div>
                                                            
                                                            <div class="col-lg-offset-1 col-lg-4" align="right">
                                                                <h5 align="left">Date supérieure</h5>
                                                                <div class="form-group">
                                                                    <input type="date" id="dateFinBil" class="horizontal-input form-control">
                                                                </div>
                                                            </div>                                                
                                                            
                                                            <div class="col-lg-offset-1 col-lg-2" align="left"><br>
                                                                <button type="button" id="btnBilan" class="btn btn-default form-control style-button" style="position: relative;right: 20px;">Voir</button>
                                                            </div>

                                                        </div> 
                                                        <div class="row" id="bilanPer">
                                                            <p><h3 id="bilanTitle"></h3></p>
                                                            <div class="col-lg-6" align="right">
                                                                <h3 id="legGainPer" align="left" style="color: #0abad6; position: relative;left: 100px;"></h3>
                                                                <h3 id="legRegPer" align="left" style="color: #424a5d; position: relative;left: 100px;"></h3>
                                                                    <canvas id="statBilanPer" height="300" width="400" style="background-color: #e2e2e2"></canvas>
                                                            </div>
                                                            <div class="col-lg-6" style="position: relative;right: 40px">
                                                                <div class="large-space"></div>
                                                                <h3>Le bilan est : <span id="paraCommentPer"></span></h3>
                                                                <h3 id="resultPer"></h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-offset-4 col-lg-4">
                                        <button type="button" id="btnImprimerBilan" class="btn btn-default form-control style-button"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimer</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>


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

        <script src="../assets/js/bilan/bilanSimple.js" type="text/javascript"></script>
        <script src="../modules/js/chart-master/Chart.js" type="text/javascript"></script>

        <!-- <script>
            //custom select box
            $(function(){
                $('select.styled').customSelect();
            });
        </script> -->

    </body>
</html>