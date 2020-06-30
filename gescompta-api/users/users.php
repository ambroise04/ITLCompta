 <?php

 	require("../connexionClassique.php");
 	require("function.php");

 	$query = '';

 	$output = array();

 	$query .= "SELECT * FROM utilisateurs WHERE OnOff = 1 ORDER BY idUser DESC";

 	$statement = $bd->prepare($query);

 	$statement->execute();
 	
 	$result = $statement->fetchAll();
 	
 	$data = array();
 	
 	$filtered_rows = get_total_all_records();/*$statement->rowCount();*/

 	foreach($result as $row){

 		$image = '';

 		if($row["image"] != ''){

 			$image = '<img src="../assets/img/imgUser/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />';

 		} else {

 			$image = '';
 		}

 		$sub_array = array();

 		$sub_array[] = $image;

 		$sub_array[] = $row["idUser"];

 		$sub_array[] = $row["nom"];

 		$sub_array[] = $row["prenom"];

 		$sub_array[] = $row["login"];

 		/*$sub_array[] = $row["password"];

 		$sub_array[] = $row["email"];

 		$sub_array[] = $row["actif"];

 		$sub_array[] = $row["OnOff"];*/
 		if ($row["actif"] == 1) {

 			$sub_array[] = '<center><button type="button" name="desactiver" id="'.$row["idUser"].'" class="btn btn-primary btn-xs desactiver">Désactiver</button></center>';
 		} else{

 			$sub_array[] = '<center><button type="button" name="desactiver" id="'.$row["idUser"].'" class="btn btn-primary btn-xs desactiver">Activer</button></center>';
 		}

 		$sub_array[] = '<center><button type="button" name="modifier" id="'.$row["idUser"].'" class="btn btn-warning btn-xs modifier">Modifier</button></center>';

 		$sub_array[] = '<center><button type="button" name="supprimer" id="'.$row["idUser"].'" class="btn btn-danger btn-xs supprimer">Supprimer</button></center>';

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