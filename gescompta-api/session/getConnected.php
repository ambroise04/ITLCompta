<?php
	require("../connexionClassique.php");

	$data = array();
    $output = array();

	$last = $bd->query("SELECT MAX(dateconnexion) as dernier FROM session WHERE state = 1");
	while($row = $last->fetch()){
		$data[] = $row["dernier"];
    }

	$donnees = $bd->query('SELECT * FROM session WHERE state = 1 AND dateconnexion = \''.$data[0].'\'');
    while($row = $donnees->fetch()){
    	$output["id"] = $row["id"];
    	$output["idUser"] = $row["idUser"];
        $output["prenom"] = $row["prenom"]; 
        $output["login"] = $row["login"];
        $output["passe"] = $row["pw"];
        $output["type"] = $row["type"];
    }

    if (count($output) != 0) {
	 	echo json_encode($output);
    } else {
    	echo json_encode("NULL");
	}

?>