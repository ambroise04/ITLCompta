 <?php

 	require("../connexionClassique.php");
 	require("functionFrs.php");

 	$query = '';

 	$output = array();

 	$query .= "SELECT * FROM fournisseurs";

 	$statement = $bd->prepare($query);

 	$statement->execute();
 	
 	$result = $statement->fetchAll();
 	
 	$data = array();
 	
 	$filtered_rows = get_total_all_records();

 	foreach($result as $row){

 		$sub_array = array();

 		//$sub_array[] = $row["id"];

 		$sub_array[] = $row["nomFrs"];

 		$sub_array[] = $row["code"];

 		$sub_array[] = $row["telFrs"];

 		$sub_array[] = $row["emailFrs"];

 		$sub_array[] = $row["adresseFrs"];

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