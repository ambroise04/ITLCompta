<!DOCTYPE html>
<html lang="fr">
	<?php

		if(!isset($_SESSION['user']) && !empty($_SESSION['user'])){
			header ("location : login.php");
		}else{
		    $_GET['_title'] = 'Ecriture - ITLCOMPTA';
		    $_GET['_page'] = 'ecriture.php';
		    include "../partials/head.php";
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
			<span id="top-ecriture"></span>
	        <section class="panelPos wrapper">
	        	<div class="topSpace">
                    <h2>Ecriture comptable</h2>
                    <h5>Une écriture comptable est une opération consistant à enregistrer un flux commercial,<br> économique ou financier à l'intérieur de comptes. Les écritures sont portées dans un journal.</h5>
                </div>
                <div class="row mt">
                    <div class="col-lg-12">
                    	<div class="panel panel-default">                                    
                    		<div class="white-panel">
	                            <div class="panel-body">
	                            	<br>
	                            	<form method="post" action="" id="formEcrit">
	                            		<div class="form-group">
	                            			<!-- Détails des règlements clientels -->
	                            			<!-- <div class="in-title">
	                                            <h4>Détails journal</h4>
	                                        </div>
	                                        <div class="panel panel-default" style="background-color: #5f7c8b">
	                                            <div class="row in-space">
	                                                <div class="col-lg-4">
	                                                    <div class="input-group">
	                                                        <span class="input-group-addon" id="basic-addon1">Ancien solde</span>
	                                                        <input type="text" class="form-control" aria-describedby="basic-addon1" readonly><span class="input-group-addon" id="basic-addon1">F CFA</span>
	                                                    </div>
	                                                </div>
	                                                <div class="col-lg-offset-4 col-lg-4">
	                                                    <div class="input-group">
	                                                        <span class="input-group-addon" id="basic-addon1">Totaux journal</span>
	                                                        <input type="text" class="form-control" aria-describedby="basic-addon1" readonly><span class="input-group-addon" id="basic-addon1">F CFA</span>
	                                                    </div>
	                                                </div>                                           
	                                            </div>
	                                            <div class="row in-space">
	                                                <div class="col-lg-offset-4 col-lg-4">
	                                                    <div class="input-group">
	                                                        <span class="input-group-addon" id="basic-addon1">Nouveau solde</span>
	                                                        <input type="text" class="form-control" aria-describedby="basic-addon1" readonly><span class="input-group-addon" id="basic-addon1">F CFA</span>
	                                                    </div>
	                                                </div>                                           
	                                            </div>                                       
	                                            <!-- Tableau journal -->
	                                            <!-- <div class="row in-space" hidden>
	                                                <table class="table table-bordered table-striped" id="tableJournal">
				                                    	<caption></caption>
				                                        <thead>
				                                             <tr>
				                                                <th width="10%"><center>Jour</center></th>
				                                                <th width="10%"><center>Compte</center></th>
				                                                <th width="30%"><center>Libellé</center></th>
				                                                <th width="10%"><center>Date</center></th>
				                                                <th width="10%"><center>Débit</center></th>
				                                                <th width="10%"><center>Crédit</center></th>
				                                             </tr>
				                                        </thead>    
				                                    </table>
	                                            </div> -->
	                                            <!-- Fin tableau journal -->
	                                        <!-- </div> -->
			                            	<div class="in-title">
			                            		<h4>Ecriture principale</h4>
			                            	</div>
			                            	<div class="panel panel-default">
			                            		<form id="ecritPrinc">
				                            		<div class="row in-space">

				                            			<div class="col-lg-3">
				                            				<div class="input-group">
														    	<span class="input-group-addon" id="basic-addon1">Journal</span>
														    	<input type="text" class="form-control journalEcrit" aria-describedby="basic-addon1" autocomplete="off" id="tags" required="required">
															</div>
															<p class="hidden text-left" style="color: red">Champ mal renseigné! Veuillez entrer le journal</p>
				                            			</div>

				                            			<div class="col-lg-1" align="right">
				                            				<div class="input-group">
														    	<button type="button" class="btn btn-default form-control"><a title="Cliquez pour choisir un journal"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a></button>
															</div>
				                            			</div>

				                            			<div class="col-lg-4">
				                            				<div class="input-group">
														    	<span class="input-group-addon" id="basic-addon1">Compte</span>
														    	<input type="text" class="form-control compteEcrit" aria-describedby="basic-addon1" autocomplete="off" required="required">
															</div>
															<p class="hidden text-left" style="color: red">Champ mal renseigné! Veuillez saisir un compte valide</p>
				                            			</div>
				                            			
				                            			<div class="col-lg-3">
				                            				 <div class="input-group">
														    	<span class="input-group-addon" id="basic-addon1">Mois</span>
														    	<select id="moisEcrit" name="typeEcrit" class="form-control">
														    		<option value="1">Janvier</option>
														    		<option value="2">Février</option>
														    		<option value="3">Mars</option>
														    		<option value="4">Avril</option>
														    		<option value="5">Mai</option>
														    		<option value="6">Juin</option>
														    		<option value="7">Juillet</option>
														    		<option value="8">Août</option>
														    		<option value="9">Septembre</option>
														    		<option value="10">Octobre</option>
														    		<option value="11">Novembre</option>
														    		<option value="12">Décembre</option>
														    	</select>
															</div>				
				                            			</div>
				                            		</div>

				                            		<div class="row in-space">

				                            			<div class="col-lg-4">
				                            				<div class="input-group">
														    	<span class="input-group-addon" id="basic-addon1">Montant</span>
														    	<input type="text" class="form-control" aria-describedby="basic-addon1" required="required" id="montantEcrit"><span class="input-group-addon" id="basic-addon1">F CFA</span>
															</div>
															<p class="hidden text-left" style="color: red">Champ mal renseigné! Veuillez saisir un montant valide</p>
					                            		</div>	

					                            		<div class="col-lg-4">
				                            				<div class="input-group">
														    	<span class="input-group-addon" id="basic-addon1">Passer l'écriture au</span>
														    	<select name="typeEcrit" class="form-control" id="typeEcrit">
														    		<option value="charge">Crédit</option>
														    		<option value="reglement">Débit</option>
														    	</select>
															</div>
				                            			</div>

				                            			<div class="col-lg-4">
				                            				 <div class="input-group">
														    	<span class="input-group-addon" id="basic-addon1">Date</span>
														    	<input type="date" class="form-control" aria-describedby="basic-addon1" id="dateEcrit">
															</div>				
				                            			</div>

				                            		</div>

				                            		<div class="row in-space">
				                            			
				                            			<div class="col-lg-4">
				                            				<div class="input-group">
														    	<span class="input-group-addon" id="basic-addon1">Code Client ou Fournisseur</span>
														    	<input type="text" class="form-control" aria-describedby="basic-addon1" required="required" id="codeCltFrs">
															</div>
															<p class="hidden text-left" style="color: red">Champ mal renseigné! Veuillez entrer le code du client ou du fournisseur.</p>
				                            			</div>

				                            			<div class="col-lg-4">
				                            				<div class="input-group">
														    	<span class="input-group-addon" id="basic-addon1">Libellé</span>
														    	<input type="text" class="form-control" aria-describedby="basic-addon1" required="required" id="libelleEcrit">
															</div>
															<p class="hidden text-left" style="color: red">Champ mal renseigné! Veuillez entrer le libellé de l'écriture</p>
				                            			</div>

				                            			<div class="col-lg-4">
				                            				<div class="input-group">
														    	<span class="input-group-addon" id="basic-addon1">Documents justificatifs</span><input type="file" class="form-control" aria-describedby="basic-addon1" multiple="multiple" name="piecesJustificatives" id="piecesEcrit">
														    	
															</div>
														</div>
				                            		</div>
			                            		</form>
			                            	</div>
			                            
			                            	<div class="in-title">
			                            		<h4>Ecriture de compensation</h4>
			                            	</div>
			                            	<div class="panel panel-default">
			                            		<form id="ecritComp">
				                            		<div class="row in-space">

				                            			<div class="col-lg-3">
				                            				<div class="input-group">
														    	<span class="input-group-addon" id="basic-addon1">Journal</span>
														    	<input type="text" class="form-control" aria-describedby="basic-addon1" autocomplete="off" id="jrnlEcrit2" disabled>
															</div>
				                            			</div>	 

				                            			<div class="col-lg-offset-1 col-lg-4">
				                            				<div class="input-group">
														    	<span class="input-group-addon" id="basic-addon1">Compte</span>
														    	<input type="text" class="form-control compteEcrit" aria-describedby="basic-addon1" autocomplete="off" required="required" id="compteEcrit2">
															</div>
															<p class="hidden text-left" style="color: red">Champ mal renseigné! Veuillez saisir un compte valide</p>
				                            			</div>

				                            			<div class="col-lg-3">
				                            				 <div class="input-group">
														    	<span class="input-group-addon" id="basic-addon1">Mois</span>
														    	<select id="moisEcrit2" name="typeEcrit" class="form-control" disabled>
														    		<option value="1">Janvier</option>
														    		<option value="2">Février</option>
														    		<option value="3">Mars</option>
														    		<option value="4">Avril</option>
														    		<option value="5">Mai</option>
														    		<option value="6">Juin</option>
														    		<option value="7">Juillet</option>
														    		<option value="8">Août</option>
														    		<option value="9">Septembre</option>
														    		<option value="10">Octobre</option>
														    		<option value="11">Novembre</option>
														    		<option value="12">Décembre</option>
														    	</select>
															</div>				
				                            			</div>

				                            		</div>

				                            		<div class="row in-space">

				                            			<div class="col-lg-4">
				                            				<div class="input-group">
														    	<span class="input-group-addon" id="basic-addon1">Montant</span>
														    	<input type="text" class="form-control" aria-describedby="basic-addon1" id="montantEcrit2" disabled><span class="input-group-addon" id="basic-addon1">F CFA</span>
															</div>
					                            		</div>

					                            		<div class="col-lg-4">
				                            				<div class="input-group">
														    	<span class="input-group-addon" id="basic-addon1">Passer l'écriture au</span>
														    	<select name="typeEcrit" class="form-control" id="typeEcrit2" disabled>
														    		<option value="reglement">Débit</option>
														    		<option value="charge">Crédit</option>
														    	</select>
															</div>
				                            			</div>

				                            			<div class="col-lg-4">
				                            				 <div class="input-group">
														    	<span class="input-group-addon" id="basic-addon1">Date</span>
														    	<input type="date" class="form-control" aria-describedby="basic-addon1" id="dateEcrit2" disabled>
															</div>				
				                            			</div>		              

				                            		</div>

				                            		<div class="row in-space">

				                            			<div class="col-lg-offset-1 col-lg-4">
				                            				<div class="input-group">
														    	<span class="input-group-addon" id="basic-addon1">Code Client ou Fournisseur</span>
														    	<input type="text" class="form-control" aria-describedby="basic-addon1" id="codeCltFrs2" disabled>
															</div>
				                            			</div>

				                            			<div class="col-lg-offset-2 col-lg-4">
				                            				<div class="input-group">
														    	<span class="input-group-addon" id="basic-addon1">Libellé</span>
														    	<input type="text" class="form-control" aria-describedby="basic-addon1" required="required" id="libelleEcrit2">
															</div>
															<p class="hidden text-left" style="color: red">Champ mal renseigné! Veuillez entrer le libellé de l'écriture</p>
				                            			</div>

				                            		</div>
						                            
			                            		</form>
			                            	</div>
			                            </div>
			                            
			                            <div class="row in-space">
		                            		<div class="form-group">
		                            			<div class="col-lg-4">
		                            				<button type="reset" class="btn btn-default style-button form-control">Annuler</button>
		                            			</div>
		                            			<div class="col-lg-offset-4 col-lg-4">
		                            				<button type="submit" class="btn btn-default form-control style-button" id="btnSoumEcrit">Soumettre</button>
		                            			</div>
		                            		</div>
		                            	</div>

			                        </form>
			                    </div>
			                </div>
			            </div>
		            </div>
		        </div>             	
		                
	        </section><!--/wrapper -->
	    </section> <!-- Main-content -->

	    <?php
			include "../partials/footer.php";	    
		?>
	</section><!-- Container -->
    
	<?php	    
	    include "../partials/scripts.php";
	?>
	<script src="../assets/js/ecriture/addEcrit.js" type="text/javascript"></script>

	<script>

        $(function() {
            var source = '../../gescompta-api/journal/liste.php';
            $(".journalEcrit").autocomplete({
                source : source
            });

            var sourceCompte = '../../gescompta-api/compte/liste.php';
            $(".compteEcrit").autocomplete({
                source : sourceCompte
            });
        });

    </script>

</body>
</html>