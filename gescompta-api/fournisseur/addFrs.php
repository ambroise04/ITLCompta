<?php

    require("../connexionClassique.php");
    
    /*$_POST["action"] = "add";
    $_POST["nom"] = "NEACOM-PS";
    $_POST["code"] = "401NE2";
    $_POST["tel"] = 22229090;
    $_POST["adresse"] = "Av. Cocoti Lome-TOGO";
    $_POST["email"] = "neacomps@neacomp.tg";*/

    if (isset($_POST["action"]) && $_POST["action"] == "add" ) {

        $statement = $bd->prepare(
            "SELECT COUNT(idFrs) AS nbreDeFrs FROM fournisseurs"
        );

        $statement->execute();  

        $result = $statement->fetchAll();

        $output = array();

        foreach($result as $row){
            $output = $row["nbreDeFrs"];            
        }

        if (count($output) != 0) {
            
            $_POST["code"] = $_POST["code"].$output;
        }

        $statement = $bd->prepare('
            INSERT INTO fournisseurs (nomFrs, code, telFrs, adresseFrs, emailFrs)
            VALUES(:nomFrs, :code, :telFrs, :adresseFrs, :emailFrs)
        ');

        $result = $statement->execute(
            array(
                ':nomFrs'      =>    $_POST["nom"],
                ':code'        =>    $_POST["code"],
                ':telFrs'      =>    $_POST["tel"],
                ':adresseFrs'  =>    $_POST["adresse"],
                ':emailFrs'    =>    $_POST["email"]
            )
        );

        if (!empty($result)) {
            echo json_encode("OK");
        }
    }
?>