<?php

    require("../connexionClassique.php");
/*$_POST["action"] ="add";
$_POST["descDep"]="TVA";
$_POST["montantDep"]=20000;
$_POST["dateDep"]="2017-02-01";
$_POST["nomFrs"]=1;
$_POST["ecritDep"]=2;
$_POST["compteDep"]=60;*/

    if (isset($_POST["action"]) && $_POST["action"] == "add" ) {

        $statement = $bd->prepare('
            INSERT INTO charges (libelleCharge, montantCharge, dateCharge, OnOff, idFrs, refEcrit)
            VALUES(:libelleCharge, :montantCharge, :dateCharge, :OnOff, :idFrs, :refEcrit)
        ');

        $libelleCharge = $_POST["descDep"];
        $montantCharge = $_POST["montantDep"];
        $dateCharge = $_POST["dateDep"];
        $OnOff = 1;
        $idFrs = $_POST["nomFrs"];
        $refEcrit = $_POST["ecritDep"];

        $result = $statement->execute(
            array(
                ':libelleCharge'      =>    $libelleCharge,
                ':montantCharge'      =>    $montantCharge,
                ':dateCharge'         =>    $dateCharge,
                ':OnOff'              =>    $OnOff,
                ':idFrs'              =>    $idFrs,
                ':refEcrit'           =>    $refEcrit
            )
        );

        if (!empty($result)) {
            echo json_encode("OK");
        }else{
            echo "RIEN";
        }
    }
?>