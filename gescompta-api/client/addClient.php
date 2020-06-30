<?php

    require("../connexionClassique.php");
    
    /*$_POST["action"] = "add";
    $_POST["nom"] = "KANGNI";
    //$_POST["denomination"] = "ITLABO";
    $_POST["prenom"] = "Kplolanyuie"; 
    $_POST["tel"] = 90876756;
    $_POST["adresse"] = "Lome-Togo";
    $_POST["email"] = "kangni@gmail.com";
    $_POST["code"] = "411KK";*/

    if (isset($_POST["action"]) && $_POST["action"] == "add") {

        //Test pour voir s'il faut enregistrer dans la table clientphysiques ou clientmorales
        if (isset($_POST["nom"]) && !empty($_POST["nom"])) {

            //Recherche du nombre de clients dans personnesphysiques pour ajouter ce nombre au code
            $statement = $bd->prepare(
            "SELECT COUNT(id) AS nbreDeClients FROM personnephysiques"
            );

            $statement->execute();  

            $result = $statement->fetchAll();

            $output = array();

            foreach($result as $row){
                $output = $row["nbreDeClients"];            
            }

            if (count($output) != 0) {
                
                $_POST["code"] = $_POST["code"].$output;
            }
            
            //Requete d'insertion du nouveau client dans personnephysiques
            $statement = $bd->prepare('
                INSERT INTO personnephysiques (nom, prenom, numClient, adresseClient, emailClient, code, OnOff)
                VALUES(:nom, :prenom, :numClient, :adresseClient, :emailClient, :code, :OnOff)
            ');

            $result = $statement->execute(
                array(
                    ':nom'               =>    $_POST["nom"],
                    ':prenom'            =>    $_POST["prenom"],
                    ':numClient'         =>    $_POST["tel"],
                    ':adresseClient'     =>    $_POST["adresse"],
                    ':emailClient'       =>    $_POST["email"],
                    ':code'              =>    $_POST["code"],
                    ':OnOff'             =>    1
                )
            );

            if (!empty($result)) {
                echo json_encode("OK");
            }
        } else if (isset($_POST["denomination"]) && !empty($_POST["denomination"])) {

            //Recherche du nombre de clients dans personnesphysiques pour ajouter ce nombre au code
            $statement = $bd->prepare(
            "SELECT COUNT(id) AS nbreDeClients FROM personnemorales"
            );

            $statement->execute();  

            $result = $statement->fetchAll();

            $output = array();

            foreach($result as $row){
                $output = $row["nbreDeClients"];            
            }

            if (count($output) != 0) {
                $_POST["code"] = $_POST["code"].$output;
            }
            
            //Requete d'insertion du nouveau client dans personnemorales
            $statement = $bd->prepare('
                INSERT INTO personnemorales (denomination, numClient, adresseClient, emailClient, code, OnOff)
                VALUES(:denomination, :numClient, :adresseClient, :emailClient, :code, :OnOff)
            ');

            $result = $statement->execute(
                array(
                    ':denomination'      =>    $_POST["denomination"],
                    ':numClient'         =>    $_POST["tel"],
                    ':adresseClient'     =>    $_POST["adresse"],
                    ':emailClient'       =>    $_POST["email"],
                    ':code'              =>    $_POST["code"],
                    ':OnOff'             =>    1
                )
            );

            if (!empty($result)) {
                echo json_encode("OK");
            }
        }
    }
?>