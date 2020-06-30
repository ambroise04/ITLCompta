<?php
	require("../connexionClassique.php");
	
	if (isset($_POST["journal"]) && !empty($_POST["journal"])) {

        $statement = $bd->prepare(
            "SELECT * FROM journals WHERE nomJournal = :nomJournal LIMIT 1"
        );

    	$statement->execute(
            array(
                ':nomJournal'    => $_POST["journal"]   
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