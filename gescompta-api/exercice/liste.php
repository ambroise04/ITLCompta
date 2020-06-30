<?php
	require("../connexionClassique.php");	
	$_GET['term'] = "Exe";
	$term = $_GET['term'];

	$query = $bd->prepare('SELECT * FROM exercices WHERE anneeExo LIKE
	:term OR libelleExo LIKE :term');

	$query->execute(array('term' => '%'.$term.'%','term' => '%'.$term.'%'));

	$array = array(); 
	$date = array();

	while($donnee = $query->fetch()) {
		$date = explode("-", $donnee['anneeExo']);
		$annee = $date[0];
		array_push($array, $annee); // et on ajoute celles-ci à notre tableau
	} 

	echo json_encode($array);

?>