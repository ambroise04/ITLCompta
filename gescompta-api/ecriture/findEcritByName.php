<?php
    require("../connexionClassique.php");
    
    //$_POST["nomEcrit"] = 'Vente de PC';
    if (isset($_POST["nomEcrit"]) && !empty($_POST["nomEcrit"])) {

        $statement = $bd->prepare(
            "SELECT * FROM ecritures WHERE libelleEcrit = :libelle LIMIT 1"
        );

        $statement->execute(
            array(
                ':libelle'    => $_POST["nomEcrit"]   
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