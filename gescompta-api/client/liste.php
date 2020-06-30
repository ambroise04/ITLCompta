<?php
	require("../connexionClassique.php");	
	//$_GET['term'] = 'LA';
	$term = $_GET['term'];

	$query = $bd->prepare('SELECT * FROM personnephysiques WHERE nom LIKE
	:term OR prenom LIKE :term');

	$query->execute(array('term' => '%'.$term.'%','term' => '%'.$term.'%'));

	$array = array(); 

	while($donnee = $query->fetch()) {
		$nom = $donnee['nom'];
		$prenom = $donnee['prenom'];
		$complet = ''.$nom.' '.$prenom;
		array_push($array, $complet); // et on ajoute celles-ci à notre tableau
	} 



	$query = $bd->prepare('SELECT * FROM personnemorales WHERE denomination LIKE
	:term');

	$query->execute(array('term' => '%'.$term.'%'));

	while($donnee = $query->fetch()) {

		$denomination = $donnee['denomination'];
		array_push($array, $denomination);
	}

	echo json_encode($array);

?>