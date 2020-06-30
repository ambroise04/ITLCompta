<?php
    require("../connexionClassique.php");
    //$_POST["nomFrs"] = "SAMEX-TOGO";
    if (isset($_POST["nomFrs"]) && !empty($_POST["nomFrs"])) {

        $query = $bd->prepare('SELECT * FROM fournisseurs WHERE nomFrs = :nom LIMIT 1');

        $query->execute(array('nom' => $_POST["nomFrs"]));

        $data = array();

        $donnee = $query->fetch();
        
        $codeFrs = $donnee['code'];
        
        if(count($codeFrs) != 0) {

            $statement = $bd->prepare("SELECT * FROM ecritures WHERE codeClient = :code");

            $statement->execute(array(':code' => $codeFrs)); 

            $result = $statement->fetchAll();

            $output = array();

            foreach($result as $row){

                $output["idEcrit"] = $row["id"];

                $output["libelle"] = $row["libelleEcrit"];

                $data[] = $output;

            }

            echo json_encode($data);

        } else {
            echo "NULL";
        }
     }

?>