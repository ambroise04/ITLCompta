<?php

    function getTotalDebit($journal,$dateDebut,$dateFin)
    {
        
        require("../connexionClassique.php");
    
        $statement = $bd->prepare(
            "SELECT SUM(montant) AS totalDebit FROM ecritures WHERE idJournal = :idJournal AND dateEcrit <= :fin AND dateEcrit >= :debut AND idTypeEcrit = 2"
        );

        $statement->execute(
            array(
                ':idJournal'  => $journal,
                ':debut'      => $dateDebut,
                ':fin'        => $dateFin
            )
        );  

        $result = $statement->fetchAll();

        $output = array();

        foreach($result as $row){
            $output = $row["totalDebit"];            
        }

        return $output;

    }

?>