<?php
    function getTotalPaidProjet() {
$_POST["projet"] = 2;
        require("../connexionClassique.php");

        $statement = $bd->prepare(
            "SELECT SUM(montantReglemt) AS montant FROM reglements WHERE id = :idProjet"
        );

    	$statement->execute(
            array(
                ':idProjet'    => $_POST["projet"]   
            )
        );	

        $result = $statement->fetchAll();

        $output = array();

        foreach($result as $row){
            $output = $row["montant"];            
        }

        return $output;
    }
    echo getTotalPaidProjet();

?>