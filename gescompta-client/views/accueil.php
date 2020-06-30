<!DOCTYPE html>
<html lang="fr">
<?php
    $_GET['_title'] = 'Accueil - ITLCOMPTA';
    $_GET['_page'] = 'accueil.php';
    include "../partials/head.php";
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
	        <section class="wrapper" id="top-accueil">
	        	<div class="row mt">
	        		<div class="col-md-4 col-sm-4 mb" align="left">
	          			<p><img src="../assets/img/logoSansFont2.jpg" alt="Logo ITLabo" style="width: 30%; height: 30%; float: left;">
	          				<h2>&nbsp;&nbsp;ITLabo</h2> 
	          			</p>
	          		</div>
	        	</div>

	        	<div class="row">
	        		<div class="col-lg-9 main-chart">
			        	<div class="row mb ml">
			          		<div class="col-md-3 col-sm-3 box0">
		              			<a href="ecriture.php#main-content"><div class="box1">
						  			<img src="../assets/img/themify_e61d(0)_128.png" alt="Cog icon">
						  			<h3>Passer une écriture</h3>
		              			</div></a>
						  		<p style="color: #0abad6">Passer une écriture comptable</p>
		              		</div>

		              		<div class="col-md-3 col-sm-3 box0">
		              			<a href="parametrage.php"><div class="box1">
						  			<img src="../assets/img/themify_e64d(0)_128.png" alt="Cog icon">
						  			<h3>Ajouter un compte</h3>
		              			</div></a>
						  		<p style="color: #0abad6">Enregistrer un compte pour pouvoir faire des opérations dessus.</p>
		              		</div>

		              		<div class="col-md-3 col-sm-3 box0">
		              			<a href="parametrage.php"><div class="box1">
						  			<img src="../assets/img/linea_50(0)_128.png" alt="Cog icon">
						  			<h3>Configurer la TVA</h3>
		              			</div></a>
						  		<p style="color: #0abad6">Définissez la TVA applicable aux différences écritures comptables.</p>
		              		</div>

		              		<div class="col-md-3 col-sm-3 box0 mb">
		              			<a href="parametres.php"><div class="box1">
						  			<img src="../assets/img/themify_e603(0)_128.png" alt="Paramètres">
						  			<h3>Paramètres d'utilisateur</h3>
		              			</div></a>
						  		<p style="color: #0abad6">Modifiez le Mot de passe.</p>
		              		</div>	
			        	</div>

		           		<div class="row">
		            		<!-- DEPENSES -->
		                  	<div class="col-md-4 col-sm-4 mb">
		                  		<div class="white-panel pn donut-chart">
		                  			<div class="white-header">
							  			<h5>Dépenses</h5>
		                  			</div>
									<div class="row">
										<div class="col-sm-6 col-xs-6 goleft">
											<p><i class="fa fa-database"></i> 70%</p>
										</div>
		                      		</div>
									<canvas id="serverstatus01" height="120" width="120"></canvas>
									<script>
										var doughnutData = [
												{
													value: 70,
													color:"#68dff0"
												},
												{
													value : 30,
													color : "#fdfdfd"
												}
											];
											var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
									</script>
		                      	</div><!--/grey-panel -->
		                  	</div><!-- /col-md-4-->

		                  	<div class="col-md-4 col-sm-4 mb">
		                  		<div class="white-panel pn">
		                  			<div class="white-header">
							  			<h5>Règlements</h5>
		                  			</div>
									<div class="row">
										<div class="col-sm-6 col-xs-6 goleft">
											<p><i class="fa fa-paypal"></i> 122</p>
										</div>
										<div class="col-sm-6 col-xs-6"></div>
		                      		</div>
		                      		<div class="centered">
										<img src="assets/img/product.png" width="120">
		                      		</div>
		                  		</div>
		                  	</div><!-- /col-md-4 -->

		                  	<div class="col-md-4 col-sm-4 mb">
		                  		<div class="white-panel pn">
		                  			<div class="white-header">
							  			<h5>Chiffre d'affaires</h5>
		                  			</div>
									<div class="row">
										<div class="col-sm-6 col-xs-6 goleft">
											<p><i class="fa fa-money"></i> 220.200 F CFA</p>
										</div>
										<div class="col-sm-6 col-xs-6"></div>
		                      		</div>
		                      		<div class="centered">
										<img src="assets/img/product.png" width="120">
		                      		</div>
		                  		</div>
		                  	</div><!-- /col-md-4 -->

		       			</div> 

		       			
	       			</div>

	       			<div class="col-lg-3 ds">
	       				<!-- CALENDAR-->
	                    <div id="calendar" class="mb">
	                        <div class="panel green-panel no-margin">
	                            <div class="panel-body">
	                                <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
	                                    <div class="arrow"></div>
	                                    <h3 class="popover-title" style="disadding: none;"></h3>
	                                    <div id="date-popover-content" class="popover-content"></div>
	                                </div>
	                                <div id="my-calendar"></div>
	                            </div>
	                        </div>
	                    </div><!-- / calendar -->
	                      
	                 </div><!-- /col-lg-3 -->
       			</div>

	        </section><!-- /wrapper -->
	    </section>
	    
	    <?php
			include "../partials/footer.php";	    
		?>

	</section>
    
	<?php	    
	    include "../partials/scripts.php";
	?>

	<script src="../modules/js/sparkline-chart.js"></script>    
	<script src="../modules/js/zabuto_calendar.js"></script>
	
	<script type="text/javascript">
        $(document).ready(function () {
            var unique_id = $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Bienvenu dans ITLCompta!',
                // (string | mandatory) the text inside the notification
                text: 'Cette application sert à gérer la Comptabilité de ITLabo. <a href="www.228itlabo.com" target="_blank" style="color:#ffd777">Visiter le site de ITLabo</a>',
                // (string | optional) the image to display on the left
                image: '../modules/img/ui-sam.jpg',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: true,
                // (int | optional) the time you want it to be alive for before fading out
                time: '',
                // (string | optional) the class name you want to apply to that specific message
                class_name: 'my-sticky-class'
            });

            return false;

            //custom select box
            $('select.styled').customSelect();
        });
    </script>

    <script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
            	
            	language: "fr",

                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Tâches prévues", badge: "00"},
                    {type: "block", label: "Dates de paiement prévues", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>

</body>
</html>