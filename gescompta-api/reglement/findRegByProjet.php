<?php
    require("../connexionClassique.php");
    require("getMontant.php");
    //require("../projet/getMontantProjet.php");

    //$_POST["projet"] = 6;

    if (isset($_POST["projet"]) && !empty($_POST["projet"])) {

        $statement = $bd->prepare(
            "SELECT * FROM reglements WHERE idProjet = :projet ORDER BY dateEnreg ASC"
        );

        $statement->execute(
            array(
                ':projet'    => $_POST["projet"]   
            )
        );  

        $result = $statement->fetchAll();

        $output = array();
        $data = array();

        $montantRestantTampon = intval(getAmount());

        foreach($result as $row){

            $output["date"] = implode('/', array_reverse(explode('-', $row["dateReglemt"])));
            $output["montant"] = $row["montantReglemt"];
            $output["restant"] = $montantRestantTampon - intval($row["montantReglemt"]);
            
            $montantRestantTampon = $montantRestantTampon - intval($row["montantReglemt"]);
            
            if ($montantRestantTampon == 0) {
                $output["solde"] = '<center><button type="button" class="btn btn-primary btn-xs" disabled="disabled">OUI</button></center>';
            } else {
                $output["solde"] = '<center><button type="button" class="btn btn-primary btn-xs" disabled="disabled">NON</button></center>';
            }

            $data[] = $output;     
        }

        if (count($data) != 0) {

            echo json_encode($data);

        } else {

            echo json_encode("NULL");

        }

    } 

?>