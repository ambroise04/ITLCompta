<?php
    require("../connexionClassique.php");

            $statement = $bd->prepare(
                "SELECT DISTINCT codeClient FROM ecritures WHERE codeClient != 'R' AND dateEcrit <= :fin AND dateEcrit >= :debut"
            );

            $statement->execute(array(':debut'     => $_POST["debut"],
                                      ':fin'       => $_POST["fin"]
                                      ));  

            $result = $statement->fetchAll();

            $output = array();
            $data = array();

            foreach($result as $row) {

                $output["compte"] = $row["codeClient"];

                //Recherche total débit
                $enonce = $bd->prepare(
                    "SELECT SUM(montant) AS totalDebit FROM ecritures WHERE codeClient = :code AND idTypeEcrit = 2"
                );

                $enonce->execute(array(':code' => $row["codeClient"]));
                $answer = $enonce->fetchAll();
                $totalDebit = 0;
                foreach ($answer as $champ) {
                    if (intval($champ["totalDebit"]) == 0) {
                        $totalDebit = "";
                    } else {
                        $totalDebit = intval($champ["totalDebit"]);
                    }
                }
                $output["debitTotal"] = $totalDebit; 

                //Recherche total cédit
                $enonce = $bd->prepare(
                    "SELECT SUM(montant) AS totalCredit FROM ecritures WHERE codeClient = :code AND idTypeEcrit = 1"
                );

                $enonce->execute(array(':code' => $row["codeClient"]));
                $answer = $enonce->fetchAll();
                $totalCredit = 0;
                foreach ($answer as $champ) {
                    if (intval($champ["totalCredit"]) == 0) {
                        $totalCredit = "";
                    } else {
                        $totalCredit = intval($champ["totalCredit"]);
                    }
                }
                $output["creditTotal"] = $totalCredit;

                //Recherche du solde
                $soldeDebit = "";
                $soldeCredit = "";
                if ($totalDebit < $totalCredit) {
                    $soldeCredit = $totalCredit-$totalDebit;
                    $soldeDebit = "";
                } else if($totalDebit == $totalCredit) {
                    $soldeDebit = "";
                    $soldeCredit = "";
                } else {
                    $soldeDebit = $totalDebit - $totalCredit;
                    $soldeCredit = "";
                }

                $output["debitSolde"] = $soldeDebit;
                $output["creditSolde"] = $soldeCredit;


                $data[] = $output;     
            }

            if (count($data) != 0) {

                echo json_encode($data);

            } else {

                echo json_encode("NULL");

            }

?>