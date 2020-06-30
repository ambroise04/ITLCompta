<?php
    require("../connexionClassique.php");
    require("getTotalCredit.php");
    require("getTotalDebit.php");
    //$_POST["journal"] = 6; $_POST["debut"] = "16/08/2017"; $_POST["fin"] = "23/08/2017";
    if (isset($_POST["journal"]) && !empty($_POST["journal"])) {

        if (isset($_POST["debut"]) && !empty($_POST["debut"]) && isset($_POST["fin"]) && !empty($_POST["fin"])) {
            
            $debut = implode('-', array_reverse(explode('/', $_POST["debut"])));
            $fin = implode('-', array_reverse(explode('/', $_POST["fin"])));

            $statement = $bd->prepare(
                "SELECT * FROM ecritures WHERE idJournal = :idJournal AND codeClient != 'R' AND dateEcrit <= :fin AND dateEcrit >= :debut ORDER BY dateEcrit DESC"
            );

            $statement->execute(array(':idJournal' => $_POST["journal"],
                                      ':debut'     => $debut,
                                      ':fin'       => $fin
                                      )
            );  

            $result = $statement->fetchAll();

            $output = array();
            $data = array();

            foreach($result as $row) {

                $output["jour"] = explode('-', $row["dateEcrit"])[2];
                $output["reference"] = $row["id"];
                $output["numCompte"] = $row["numCompte"];
                $output["numExterne"] = $row["codeClient"];
                $output["libelle"] = $row["libelleEcrit"];
                $output["date"] = implode('/', array_reverse(explode('-', $row["dateEcrit"])));
                
                if ($row["idTypeEcrit"] == 2) {
                    $output["debit"] = $row["montant"];
                    $output["credit"] = " - ";
                } else{
                    $output["credit"] = $row["montant"];
                    $output["debit"] = " - ";
                }

                $data[] = $output;     
            }

            if (count($data) != 0) {

                echo json_encode($data);

            } else {

                echo json_encode("NULL");

            }

        }

    } 

?>