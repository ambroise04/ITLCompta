<?php

    function getTotalCredit($journal,$dateDebut,$dateFin)
    {
        
        require("../connexionClassique.php");
	
        $statement = $bd->prepare(
            "SELECT SUM(montant) AS totalCredit FROM ecritures WHERE idJournal = :idJournal AND dateEcrit <= :fin AND dateEcrit >= :debut AND idTypeEcrit = 1"
        );

    	$statement->execute(
            array(
                ':idJournal'  => $journal   
            )
        );	

        $result = $statement->fetchAll();

        $output = array();

        foreach($result as $row){
            $output = $row["totalCredit"];            
        }

        return $output;

    }

?>