<?php
	require("../connexionClassique.php");
    if (isset($_POST["dateDebut"]) && isset($_POST["dateFin"]) && !empty($_POST["dateFin"]) && !empty($_POST["dateFin"])) {
        
        //Recherche du montant total des règlements
        $statement = $bd->prepare(
            "SELECT SUM(montantReglemt) AS montant FROM reglements WHERE dateReglemt <= :fin AND dateReglemt >= :debut"
        );

    	$statement->execute(array(
                                ':debut'  =>  $_POST["dateDebut"],
                                ':fin'  =>  $_POST["dateFin"]
                            ));	

        $result = $statement->fetchAll();

        $output = array();

        foreach($result as $row){
            $output['reglement'] = $row["montant"];            
        }

        //Recherche du montant total des charges
        $statement = $bd->prepare(
            "SELECT SUM(montantCharge) AS montant FROM charges WHERE dateCharge <= :fin AND dateCharge >= :debut"
        );

        $statement->execute(array(
                                ':debut'  =>  $_POST["dateDebut"],
                                ':fin'  =>  $_POST["dateFin"]
                            ));  

        $result = $statement->fetchAll();

        foreach($result as $row){
            $output['charge'] = $row["montant"];            
        }


        if (count($output) != 0) {
            echo json_encode($output);
        } else {
            echo "NULL";
        }

    }

?>