<?php
	require("../connexionClassique.php");

	$query = $bd->prepare('SELECT * FROM journals WHERE OnOff = 1');

	$query->execute();

	$array = array();
	$data = array();

	while($donnee = $query->fetch()) {

		$array["id"] = $donnee['id'];
		$array["libelle"] = $donnee['nomJournal'];
		$data[] = $array;
	} 

	echo json_encode($data);

?>