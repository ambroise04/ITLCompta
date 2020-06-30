<?php
	require("../connexionClassique.php");

	//$_POST["nomClient"] = "LABA"; $_POST["prenomClient"] = "Ambroise";

	$nom = $_POST["nomClient"];
	$prenom = $_POST["prenomClient"];

	$query = $bd->prepare('SELECT * FROM personnephysiques WHERE nom = :nom AND prenom = :prenom LIMIT 1');

	$query->execute(array('nom' => $nom,'prenom' => $prenom));

	$array = array();
	$data = array();

	$donnee = $query->fetch();
	
	$codeClient = $donnee['code'];
	
	if(count($codeClient) != 0) {

		$statement = $bd->prepare("SELECT * FROM ecritures WHERE codeClient = :code");

    	$statement->execute(array(':code' => $codeClient));	

        $result = $statement->fetchAll();

        $output = array();

        foreach($result as $row){

        	$output["idEcrit"] = $row["id"];

            $output["libelle"] = $row["libelleEcrit"];

            $data[] = $output;

        }

	 	echo json_encode($data);

	} else {

		$query = $bd->prepare("SELECT * FROM personnemorales WHERE denomination = :deno LIMIT 1");

		$query->execute(array('deno' => ''.$nom.''.$prenom)); 

		$donnee = $query->fetch();
		
		$code = $donnee['code'];

		if(count($code) != 0) {

			$statement = $bd->prepare("SELECT * FROM ecritures WHERE codeClient = :code");

	    	$statement->execute(array(':code' => $codeClient));	

	        $result = $statement->fetchAll();

	        $output = array();

	        foreach($result as $row){

	        	$output["idEcrit"] = $row["id"];

	            $output["libelle"] = $row["libelleEcrit"];

	            $data[] = $output;

	        }

		 	echo json_encode($data);

		} else {
			echo json_encode("NULL");
		}
	}

?>