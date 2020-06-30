<?php
    require("../connexionClassique.php");
    
    //$_POST["nomEcrit"] = 'Vente de PC';
    if (isset($_POST["nomFrs"]) && !empty($_POST["nomFrs"])) {

        $statement = $bd->prepare(
            "SELECT * FROM fournisseurs WHERE nomFrs = :nom LIMIT 1"
        );

        $statement->execute(
            array(
                ':nom'    => $_POST["nomFrs"]   
            )
        );  

        $result = $statement->fetchAll();

        $output = array();

        foreach($result as $row){

            $output = $row["code"];            
        }

        if (count($output) != 0) {

            echo $output;

        } else {

            echo "NULL";

        }

    } 

?>