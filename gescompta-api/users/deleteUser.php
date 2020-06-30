<?php
	require("../connexionClassique.php");
	
	if (isset($_POST["id"]) && !empty($_POST["id"])) {

        $statement = $bd->prepare(
            "UPDATE utilisateurs
            SET OnOff = :sup
            WHERE idUser = :id"
        );

    	$statement->execute(
            array(
                ':sup'    =>    0,
                ':id'     =>    $_POST["id"]
            )
        );	

        echo json_encode("OK");
    }

?>