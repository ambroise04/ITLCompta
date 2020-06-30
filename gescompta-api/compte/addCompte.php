<?php

    require("../connexionClassique.php");
    
    /*$_POST["numero"] = 664;
    $_POST["libelle"] = "Charges sociales";*/
    if (isset($_POST["numero"]) && !empty($_POST["numero"]) && isset($_POST["libelle"]) && !empty($_POST["libelle"])) {

        $statement = $bd->prepare('
            INSERT INTO comptes (id, intituleCompte)
            VALUES (:id, :intituleCompte)
        ');

        $result = $statement->execute(
            array(
                ':id'               =>    $_POST["numero"],
                ':intituleCompte'   =>    $_POST["libelle"]
            )
        );

        if (!empty($result)) {
            echo json_encode("OK");
        }
    }
?>