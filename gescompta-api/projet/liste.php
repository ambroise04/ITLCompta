 <?php

 	require("../connexionClassique.php");
 	require("functionProj.php");

 	$query = '';

 	$output = array();

 	$query .= "SELECT * FROM projets WHERE OnOff = 1 ORDER BY id DESC";

 	$statement = $bd->prepare($query);

 	$statement->execute();
 	
 	$result = $statement->fetchAll();
 	
 	$data = array();
 	
 	$filtered_rows = get_total_all_records();

 	foreach($result as $row){

 		$sub_array = array();

 		$sub_array[] = $row["libelleProjet"];

 		$sub_array[] = $row["montantProjet"];

 		//Début Recherche du nom du client
 		$client = "";

 		if ($row["idClientP"] != 0) {
 			
	 		$statement = $bd->prepare(
	            "SELECT * FROM personnephysiques WHERE id = :idClientP LIMIT 1"
	        );

	    	$statement->execute(array(':idClientP' => $row["idClientP"]));	

	        $result = $statement->fetchAll();

	        $output = array();

	        foreach($result as $line){
	            $output = "".$line["nom"]." ".$line["prenom"];
	        }

	        if (count($output) != 0) {
	            $client = $output;
	        }
 		} else if ($row["idClientM"] != 0) {
 			
 			$statement = $bd->prepare("SELECT * FROM personnemorales WHERE id = :idClientM LIMIT 1");

	    	$statement->execute(
	            array(
	                ':idClientM'    => $row["idClientM"]   
	            )
	        );	

	        $result = $statement->fetchAll();

	        $output = array();

	        foreach($result as $line){
	            $output = $line["denomination"];            
	        }

	        if (count($output) != 0) {
	            $client = $output;
	        }
 		}
 		//Fin Recherche

 		$sub_array[] = $client;

 		$sub_array[] = $row["dateOuverture"];

 		$sub_array[] = $row["dateFin"];

 		if ($row["livrer"] == 0) {

 			$sub_array[] = '<center><button type="button" class="btn btn-primary btn-xs" disabled="disabled">OUI</button></center>';
 		} else{

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