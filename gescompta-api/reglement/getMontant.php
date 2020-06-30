<?php

	function getAmount() {
		//$_POST["projet"] = 1;
		require("../connexionClassique.php");

		 $statement = $bd->prepare(
            "SELECT * FROM projets WHERE id = :id LIMIT 1"
        );

    	$statement->execute(array(':id' => $_POST["projet"]));	

        $result = $statement->fetchAll();

        $output = array();

        foreach($result as $row){
            $output = $row["montantProjet"];            
        }

        return $output;
	}

?>