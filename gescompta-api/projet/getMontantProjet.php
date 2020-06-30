<?php
	require("../connexionClassique.php");
	//$_POST["projet"] = 'ITLCompta';
	if (isset($_POST["projet"]) && !empty($_POST["projet"])) {

        $statement = $bd->prepare(
            "SELECT * FROM projets WHERE libelleProjet = :libelle LIMIT 1"
        );

    	$statement->execute(
            array(
                ':libelle'    => $_POST["projet"]   
            )
        );	

        $result = $statement->fetchAll();

        $output = array();

        foreach($result as $row){
            $output = $row["montantProjet"];            
        }

        if (count($output) != 0) {
            echo $output;
        } else {
            echo "NULL";
        }
    }

?>