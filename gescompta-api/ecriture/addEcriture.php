<?php

    require("../connexionClassique.php");
    
    /*$_POST["action"] = "add";
    $_POST["libelleEcrit"] = "Paiement M. LABA";
    $_POST["dateEcrit"] = date("Y-m-d");
    $_POST["codeExt"] = "401SA";
    $_POST["montantEcrit"] = 20000;
    $_POST["moisEcrit"] = 1;
    $_POST["typeEcrit"] = 1;
    $_POST["journalEcrit"] = 1;
    $_POST["compteEcrit"] = 2;
    $_POST["idUser"] = 1;
    $_POST["pieces"] = "momo.jpeg";*/

    if (isset($_POST["action"]) && $_POST["action"] == "add" ) {

        $statement = $bd->prepare('
            INSERT INTO ecritures (libelleEcrit, dateEcrit, mois, montant, OnOff, codeClient, idTypeEcrit, idJournal, numCompte, idUser, pieces)
            VALUES(:libelleEcrit, :dateEcrit, :mois, :montant, :OnOff, :codeExt, :idTypeEcrit, :idJournal, :numCompte, :idUser, :pieces)
        ');

        $libelleEcrit = $_POST["libelleEcrit"];
        $dateEcrit = $_POST["dateEcrit"];
        $mois = $_POST["moisEcrit"];
        $OnOff = 1;
        $montant = $_POST["montantEcrit"];
        $codeExt = $_POST["codeExt"];
        $idTypeEcrit = $_POST["typeEcrit"];
        $idJournal = $_POST["journalEcrit"];
        $numCompte = $_POST["compteEcrit"];
        $idUser = $_POST["idUser"];
        $pieces = $_POST["pieces"];

        $result = $statement->execute(
            array(
                ':libelleEcrit'      =>    $libelleEcrit,
                ':dateEcrit'         =>    $dateEcrit,
                ':OnOff'             =>    $OnOff,
                ':codeExt'           =>    $codeExt,
                ':mois'              =>    $mois,
                ':montant'           =>    $montant,
                ':idTypeEcrit'       =>    $idTypeEcrit,
                ':idJournal'         =>    $idJournal,
                ':numCompte'         =>    $numCompte,
                ':idUser'            =>    $idUser,
                ':pieces'            =>    $pieces
            )
        );

        if (!empty($result)) {
            echo json_encode("OK");
        }
    }
?>