<!DOCTYPE html>
<html lang="fr">
    <?php
        $_GET['_title'] = 'Vérouillage - ITLCOMPTA';
        $_GET['_page'] = 'lock.php';
    ?>
    <?php
        include "../partials/head.php";
    ?>

    <body onload="getTime()">
        <div id="container" >
            <div id="showtime"></div>
            <div class="col-lg-4 col-lg-offset-4">
                <div class="lock-screen">
                    <h2><a data-toggle="modal" href="#myModal"><i class="fa fa-lock"></i></a></h2>
                    <p>DÉVERROUILLER</p>
                    
                      <!-- Modal -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Nous vous souhaitons un bon retour !!!</h4>
                                </div>
                                <div class="modal-body">
                                    <p class="centered"><img class="img-circle" width="80" src="../modules/img/ui-sam.jpg"></p>
                                    <input type="password" name="password" placeholder="Mot de passe" autocomplete="off" class="form-control placeholder-no-fix" id="passeDever">
                                </div>
                                <div class="modal-footer centered">
                                    <button data-dismiss="modal" class="btn btn-theme04" type="button">Annuler</button>
                                    <button class="btn btn-theme03" type="button" id="btnDeverrouiller">Déverrouiller</button>
                                </div>
                            </div>
                        </div>
                    </div>
                      <!-- modal -->

                </div><!--/lock-screen -->
            </div><!-- /col-lg-4 -->
        </div>

        <?php
            include "../partials/scriptForVerrou.php";
        ?>
        <script type="text/javascript" src="../assets/js/jquery.crypt.js"></script>
        <script type="text/javascript" src="../assets/js/verouillage/dever.js"></script>

        <!--BACKSTRETCH-->
        <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
        <script type="text/javascript" src="../modules/js/jquery.backstretch.min.js"></script>
        <script>
            $.backstretch("../assets/img/logoSansFont2.jpg", {speed: 500});
        </script><!-- ../modules/img/login-bg.jpg -->

        <script>
            function getTime()
            {
                var today=new Date();
                var h=today.getHours();
                var m=today.getMinutes();
                var s=today.getSeconds();
                // add a zero in front of numbers<10
                h=checkTime(h);
                m=checkTime(m);
                s=checkTime(s);
                document.getElementById('showtime').innerHTML=h+":"+m+":"+s;
                t=setTimeout(function(){getTime()},500);
            }

            function checkTime(i)
            {
                if (i<10)
                {
                    i="0" + i;
                }
                return i;
            }
        </script>

    </body>
</html>
