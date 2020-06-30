 <?php

 	require("../connexionClassique.php");
 	require("functionJournal.php");

 	$query = '';

 	$output = array();

 	$query .= "SELECT * FROM journals WHERE OnOff = 1 AND cloture = 1 ORDER BY id DESC";

 	$statement = $bd->prepare($query);

 	$statement->execute();
 	
 	$result = $statement->fetchAll();
 	
 	$data = array();
 	
 	$filtered_rows = get_total_all_records();

 	foreach($result as $row){

 		$sub_array = array();

 		$sub_array[] = '<center>'.$row["codeJournal"];

 		$sub_array[] = $row["nomJournal"];

 		$sub_array[] = '<center>'.$row["dateDebut"].'</center';

 		$sub_array[] = '<center>'.$row["dateFin"].'</center';

 		if ($row["cloture"] == 1) {

 			$sub_array[] = '<center><button type="button" name="cloturer" id="'.$row["id"].'" class="btn btn-primary btn-xs cloturer">Clôturer</button></center>';
 		} else{

 			$sub_array[] = '<center><button type="button" name="cloturer" id="'.$row["id"].'" class="btn btn-primary btn-xs cloturer" disabled="disabled">Fermé</button></center>';
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