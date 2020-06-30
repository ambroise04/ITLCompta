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
	
	$id = $donnee['id'];
	
	if(count($donnee['id']) != 0) {

		$statement = $bd->prepare("SELECT * FROM projets WHERE idClientP = :id");

    	$statement->execute(array(':id' => $id));	

        $result = $statement->fetchAll();

        $output = array();

        foreach($result as $row){

        	$output["idProjet"] = $row["id"];

            $output["libelle"] = $row["libelleProjet"]; 

            $output["idClient"] = $id;

            $data[] = $output;

        }

	 	echo json_encode($data);

	} else {

		$query = $bd->prepare("SELECT * FROM personnemorales WHERE denomination = :deno LIMIT 1");

		$query->execute(array('deno' => ''.$nom.''.$prenom)); 

		$donnee = $query->fetch();
		
		$id = $donnee['id'];

		if(count($donnee['id']) != 0) {

			$statement = $bd->prepare("SELECT * FROM projets WHERE idClientM = :id");

	    	$statement->execute(array(':id' => $id));	

	        $result = $statement->fetchAll();

	        $output = array();

	        foreach($result as $row){

	        	$output["id"] = $row["idClientM"];

	            $output["libelle"] = $row["libelleProjet"];

	            $data[] = $output;

	        }

		 	echo json_encode($data);

		} else {
			echo "NULL";
		}
	}

?>