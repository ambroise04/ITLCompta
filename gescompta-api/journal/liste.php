<?php
	require("../connexionClassique.php");	
	
	$term = $_GET['term'];

	$query = $bd->prepare('SELECT * FROM journals WHERE nomJournal LIKE
	:term');

	$query->execute(array('term' => '%'.$term.'%'));

	$array = array(); 

	while($donnee = $query->fetch()) {
		$nomJournal = $donnee['nomJournal'];
		array_push($array, $nomJournal); // et on ajoute celles-ci à notre tableau
	} 

	echo json_encode($array);

?>