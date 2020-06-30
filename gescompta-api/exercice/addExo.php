<?php

    require("../connexionClassique.php");
    
    /*$_POST["action"] = "add";
    $_POST["annee"] = "2019";
    $_POST["libelle"] = "Exercice 2019";*/
    

    if (isset($_POST["action"]) && $_POST["action"] == "add" ) {

        $statement = $bd->prepare('
            INSERT INTO exercices (anneeExo, libelleExo, OnOff)
            VALUES(:anneeExo, :libelleExo, :OnOff)
        ');

        $result = $statement->execute(
            array(            
                ':anneeExo'      =>    $_POST["annee"],
                ':libelleExo'  =>    $_POST["libelle"],
                ':OnOff'    =>    1
            )
        );

        if (!empty($result)) {
            echo json_encode("OK");
        }
    }
?>