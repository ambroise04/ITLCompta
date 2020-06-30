<?php
	require("../connexionClassique.php");
	
	if (isset($_POST["annee"]) && !empty($_POST["annee"])) {

        $statement = $bd->prepare(
            "SELECT * FROM exercices WHERE anneeExo = :anneeExo LIMIT 1"
        );

    	$statement->execute(
            array(
                ':anneeExo'    => $_POST["annee"]   
            )
        );	

        $result = $statement->fetchAll();

        $output = array();

        foreach($result as $row){
            $output = $row["id"];            
        }

        if (count($output) != 0) {
            echo $output;
        } else {
            echo "NULL";
        }
    }

?>