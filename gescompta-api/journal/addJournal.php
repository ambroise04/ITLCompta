<?php

    require("../connexionClassique.php");
    
    /*$_POST["action"] = "add";
    $_POST["libelleJ"] = "Exercice 2019";
    $_POST["codeJ"] = "J2019";
    $_POST["dateDebutJ"] = "2019/01/01";
    $_POST["dateFinJ"] = "2019/12/31";
    $_POST["exoJ"] = "2019";*/

    if (isset($_POST["action"]) && $_POST["action"] == "add" ) {

        $statement = $bd->prepare('
            INSERT INTO journals (nomJournal, codeJournal, dateDebut, dateFin, idExo, cloture, OnOff)
            VALUES(:nomJournal, :codeJournal, :dateDebut, :dateFin, :idExo, :cloture, :OnOff)
        ');

        $result = $statement->execute(
            array(
                ':nomJournal'      =>    $_POST["libelleJ"],
                ':codeJournal'     =>    $_POST["codeJ"],
                ':dateDebut'       =>    $_POST["dateDebutJ"],
                ':dateFin'         =>    $_POST["dateFinJ"],
                ':idExo'           =>    $_POST["exoJ"],
                ':cloture'         =>    1,
                ':OnOff'           =>    1
            )
        );

        if (!empty($result)) {
            echo json_encode("OK");
        }
    }
?>