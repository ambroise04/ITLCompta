<?php
    require("../connexionClassique.php");
    
    if (isset($_POST["typeReg"]) && !empty($_POST["typeReg"])) {

        $statement = $bd->prepare(
            "SELECT * FROM typereglements WHERE libelleTypeReglemt = :libelle LIMIT 1"
        );

        $statement->execute(
            array(
                ':libelle'    => $_POST["typeReg"]   
            )
        );  

        $result = $statement->fetchAll();

        $output = array();

        foreach($result as $row){

            $output = $row["id"];            
        }

        if (count($output) != 0) {

            echo $output;

        } else {

            echo "NULL";

        }

    } 

?>