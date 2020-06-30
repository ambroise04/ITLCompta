<?php
	require("../connexionClassique.php");	
	//$_GET['term'] = 's';
	$term = $_GET['term'];

	$query = $bd->prepare('SELECT * FROM fournisseurs WHERE nomFrs LIKE
	:term');

	$query->execute(array('term' => '%'.$term.'%'));

	$array = array(); 

	while($donnee = $query->fetch()) {
		$nom = $donnee['nomFrs'];
		array_push($array, $nom); // et on ajoute celles-ci à notre tableau
	} 

	echo json_encode($array);

?>