<?php
    require("../connexionClassique.php");
    
    if (isset($_POST["intitule"]) && !empty($_POST["intitule"])) {

        $statement = $bd->prepare(
            "SELECT * FROM comptes WHERE intituleCompte = :intitule LIMIT 1"
        );

        $statement->execute(
            array(
                ':intitule'    => $_POST["intitule"]   
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

    } else if (isset($_POST["numCompte"]) && !empty($_POST["numCompte"])) {
        
        $statement = $bd->prepare(
            "SELECT * FROM comptes WHERE id = :numCompte LIMIT 1"
        );

        $statement->execute(
            array(
                ':numCompte'    => $_POST["numCompte"]   
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