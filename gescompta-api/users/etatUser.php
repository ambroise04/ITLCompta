<?php
	require("../connexionClassique.php");

	if (isset($_POST["id"]) && isset($_POST["action"]) && !empty($_POST["id"]) && !empty($_POST["action"])) {

        $statement = $bd->prepare(
            "UPDATE utilisateurs
            SET actif = :actif
            WHERE idUser = :id"
        );

        if($_POST["action"] == 'activer'){
        	$statement->execute(
	            array(
	                ':actif' =>    1,
	                ':id'         =>    $_POST["id"]
	            )
	        );	
        } else {
	        $statement->execute(
	            array(
	                ':actif' =>    0,
	                ':id'         =>    $_POST["id"]
	            )
	        );
        }

        echo json_encode("OK");
    }

?>