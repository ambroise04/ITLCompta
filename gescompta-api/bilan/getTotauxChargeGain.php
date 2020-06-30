<?php
	require("../connexionClassique.php");

    //Recherche du montant total des règlements
    $statement = $bd->prepare(
        "SELECT SUM(montantReglemt) AS montant FROM reglements"
    );

	$statement->execute();	

    $result = $statement->fetchAll();

    $output = array();

    foreach($result as $row){
        $output['reglement'] = $row["montant"];            
    }

    //Recherche du montant total des charges
    $statement = $bd->prepare(
        "SELECT SUM(montantCharge) AS montant FROM charges"
    );

    $statement->execute();  

    $result = $statement->fetchAll();

    foreach($result as $row){
        $output['charge'] = $row["montant"];            
    }


    if (count($output) != 0) {
        echo json_encode($output);
    } else {
        echo "NULL";
    }

?>