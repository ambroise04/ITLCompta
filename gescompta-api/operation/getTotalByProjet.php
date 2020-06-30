<?php
	require("../connexionClassique.php");
	//$_POST["projet"] = 1;
	if (isset($_POST["projet"]) && !empty($_POST["projet"])) {

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

        if (count($output) != 0) {
            echo $output;
        } else {
            echo "NULL";
        }
    }

?>