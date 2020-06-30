 <?php

 	require("../connexionClassique.php");
 	require("functionReg.php");

 	$_POST["montantTotal"] = 1000000;
 	$_POST["idProjet"] = 2;

 	$query = '';

 	$output = array();

 	$query .= "SELECT * FROM reglements WHERE idProjet = :idProjet ORDER BY dateEnreg ASC";

 	$statement = $bd->prepare($query);

 	$statement->execute(array(':idProjet'  => $_POST["idProjet"]));
 	
 	$result = $statement->fetchAll();
 	
 	$data = array();
 	
 	$filtered_rows = get_total_all_records();

 	$montantRestantTampon = intval($_POST["montantTotal"]);

 	foreach($result as $row){

 		$sub_array = array();

 		$sub_array[] = implode('/', array_reverse(explode('-', $row["dateReglemt"])));

 		$sub_array[] = $row["montantReglemt"];

 		$sub_array[] = $montantRestantTampon - intval($row["montantReglemt"]);

 		$montantRestantTampon = $montantRestantTampon - intval($row["montantReglemt"]);

 		if ($montantRestantTampon == 0) {
 			$sub_array[] = '<center><button type="button" class="btn btn-primary btn-xs" disabled="disabled">OUI</button></center>';
 		} else {
 			$sub_array[] = '<center><button type="button" class="btn btn-primary btn-xs" disabled="disabled">NON</button></center>';
 		}

 		$data[] = $sub_array;
 	}

 	$output = array(
 		"recordsTotal"  	=> $filtered_rows,
 		"recordsFiltered"	=> get_total_all_records(),
 		"data"				=> $data
 	);

 	echo json_encode($output);
 ?>