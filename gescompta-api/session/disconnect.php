<?php
	require("../connexionClassique.php");

    //$_POST["id"] = 1;
	if (isset($_POST["id"]) && !empty($_POST["id"])) {

        $statement = $bd->prepare(
            "UPDATE session
            SET state = :state"
        );

    	$result = $statement->execute(
            array(
                ':state' =>    0
            )
        );

        if ($result) {
            echo json_encode("OK");
        }
    }

?>