<?php

    require("../connexionClassique.php");
    require("../users/functionUser.php");
    
    if(isset($_POST["id"]) && !isset($_POST["action"])){

        $output = array();

        $statement = $bd->prepare(
            "SELECT * FROM utilisateurs
            WHERE idUser = '".$_POST["id"]."'
            LIMIT 1"
        );

        $statement->execute();

        $result = $statement->fetchAll();

        foreach ($result as $row) {

            $output["nom"] = $row["nom"];
            $output["prenom"] = $row["prenom"];
            $output["login"] = $row["login"];
            $output["passe"] = $row["password"];
            $output["email"] = $row["email"];
            $output['type'] = $row["idTypeUser"];

            if($row["image"] != ''){
                $output["photo"] = '<img src="'.$row["image"].'" class="img-thumbnail" width="50" height="35"/>
                ';
            } else {
                $output["photo"] = '';
            }
        }

        echo json_encode($output);
    }

    if (isset($_POST["action"]) && $_POST["action"] == "edit" ) {

        $statement = $bd->prepare(
            "UPDATE utilisateurs
            SET nom = :nom, prenom = :prenom, login = :login, email = :email, idTypeUser = :idTypeUser/*, image = :image*/
            WHERE idUser = :id"
        );

        $statement->execute(
            array(
                ':nom'        =>    $_POST["nom"],
                ':prenom'     =>    $_POST["prenom"],
                ':login'      =>    $_POST["login"],
                //':password'   =>    $_POST["password"],
                ':email'      =>    $_POST["email"],
                ':idTypeUser' =>    $_POST["idTypeUser"],
                ':id'         =>    $_POST["id"]
                /*':image'      =>    $_POST["image"],*/
            )
        );

        echo json_encode("OK");
    }
?>