<?php
	require("../connexionClassique.php");

	if (isset($_POST["id"]) && isset($_POST["action"]) && !empty($_POST["id"]) && !empty($_POST["action"])) {

        $statement = $bd->prepare(
            "UPDATE exercices
            SET cloture = :cloture
            WHERE id = :id"
        );

    	$statement->execute(
            array(
                ':cloture' =>    0,
                ':id'         =>    $_POST["id"]
            )
        );	

        echo json_encode("OK");
    }

?>