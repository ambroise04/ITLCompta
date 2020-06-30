 <?php

 	require("../connexionClassique.php");
 	require("functionExo.php");

 	$query = '';

 	$output = array();

 	$query .= "SELECT * FROM exercices";

 	$statement = $bd->prepare($query);

 	$statement->execute();
 	
 	$result = $statement->fetchAll();
 	
 	$data = array();
 	
 	$filtered_rows = get_total_all_records();

 	foreach($result as $row){

 		$sub_array = array();

 		$sub_array[] = $row["anneeExo"];

 		$sub_array[] = $row["libelleExo"];

 		if ($row["cloture"] == 1) {
 			$sub_array[] = '<button type="button" name="cloturer" id="'.$row["id"].'" class="btn btn-warning btn-xs cloturer">Clôturer</button>';
 		} else if ($row["cloture"] == 0) {
 			$sub_array[] = '<button type="button" name="cloturer" id="'.$row["id"].'" class="btn btn-warning btn-xs cloturer" disabled>Fermé</button>';
 		}

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