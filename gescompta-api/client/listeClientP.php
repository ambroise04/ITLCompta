 <?php

 	require("../connexionClassique.php");
 	require("functionClientP.php");

 	$query = '';

 	$output = array();

 	$query .= "SELECT * FROM personnephysiques";

 	$statement = $bd->prepare($query);

 	$statement->execute();
 	
 	$result = $statement->fetchAll();
 	
 	$data = array();
 	
 	$filtered_rows = get_total_all_records();

 	foreach($result as $row){

 		$sub_array = array();

 		//$sub_array[] = $row["id"];

 		$sub_array[] = $row["nom"];

 		$sub_array[] = $row["prenom"];

 		$sub_array[] = $row["code"];

 		$sub_array[] = $row["numClient"];

 		$sub_array[] = $row["emailClient"];

 		$sub_array[] = $row["adresseClient"];

 		/*$sub_array[] = '<center><button type="button" name="modifier" id="'.$row["id"].'" class="btn btn-warning btn-xs modifier">Modifier</button></center>';

 		$sub_array[] = '<center><button type="button" name="supprimer" id="'.$row["id"].'" class="btn btn-danger btn-xs supprimer">Supprimer</button></center>';*/

 		$data[] = $sub_array;
 	}

 	$output = array(
 		/*"draw"				=> intval($_POST["draw"]),*/
 		"recordsTotal"  	=> $filtered_rows,
 		"recordsFiltered"	=> get_total_all_records(),
 		"data"				=> $data
 	);

 	echo json_encode($output);
 ?>