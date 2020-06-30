<?php

    require("../connexionClassique.php");
    
    if (isset($_POST["action"]) && $_POST["action"] == "add" ) {

        $statement = $bd->prepare('
            INSERT INTO reglements (libelleReglemt, montantReglemt, dateReglemt, OnOff, idClient, idProjet, idTypeReglement, idEcrit)
            VALUES(:libelleReglemt, :montantReglemt, :dateReglemt, :OnOff, :idClient, :idProjet, :idTypeReglement, :idEcrit)
        ');

        $libelleReglemt = $_POST["commentReg"];
        $montantReglemt = $_POST["montantReg"];
        $dateReglemt = $_POST["dateReg"];
        $OnOff = 1;
        $idClient = $_POST["nomClientReg"];
        $idProjet = $_POST["projetClient"];
        $idTypeReglement = $_POST["typeReg"];
        $idEcrit = $_POST["ecritReg"];

        $result = $statement->execute(
            array(
                ':libelleReglemt'      =>    $libelleReglemt,
                ':montantReglemt'      =>    $montantReglemt,
                ':dateReglemt'         =>    $dateReglemt,
                ':OnOff'               =>    $OnOff,
                ':idClient'            =>    $idClient,
                ':idProjet'            =>    $idProjet,
                ':idTypeReglement'     =>    $idTypeReglement,
                ':idEcrit'             =>    $idEcrit
            )
        );

        if (!empty($result)) {
            echo json_encode("OK");
        }
    }
?>