<?php
	require("../connexionClassique.php");	
	
	$term = $_GET['term'];

	$query = $bd->prepare('SELECT * FROM comptes WHERE intituleCompte LIKE
	:term OR id LIKE :term');

	$query->execute(array('term' => '%'.$term.'%','term' => '%'.$term.'%'));

	$array = array(); 

	while($donnee = $query->fetch()) {
		$intituleCompte = $donnee['intituleCompte'];
		$numCompte = $donnee['id'];
		array_push($array, ''.$numCompte.' - '.$intituleCompte); // et on ajoute celles-ci à notre tableau
	} 

	echo json_encode($array);

?>