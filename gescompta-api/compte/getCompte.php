<?php
    require("../connexionClassique.php");
    // $_POST["numero"] = 12;
    if (isset($_POST["numero"]) && !empty($_POST["numero"])) {
        
        $statement = $bd->prepare(
            "SELECT * FROM comptes WHERE id = :numCompte LIMIT 1"
        );

        $statement->execute(
            array(
                ':numCompte'    => $_POST["numero"]   
            )
        );  

        $result = $statement->fetchAll();

        $output = array();

        foreach($result as $row){
            $output = $row["id"];            
        }

        if (count($output) != 0) {
            echo "OUI";
        } else {
            echo "NON";
        }
    }

?>