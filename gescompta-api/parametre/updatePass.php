<?php

    require("../connexionClassique.php");
    
    /*$_POST["nouveau"] = "kadaba";
    $_POST["action"] = "update";
    $_POST["ancien"] = "kadba";
    $_POST["user"] = "joel";*/

    if(isset($_POST["ancien"]) && !empty($_POST["ancien"])){

        $output = array();

        $statement = $bd->prepare(
            "SELECT * FROM utilisateurs
            WHERE login = :user
            LIMIT 1"
        );

        $statement->execute(array("user" => $_POST["user"]));

        $result = $statement->fetchAll();

        foreach ($result as $row) {
            $output["passe"] = $row["password"];
        }

        if ($output["passe"] != "" && $output["passe"] == sha1($_POST["ancien"])) {
                echo "YES";      
         } else {
            echo "NULL";
         }
    }

    if (isset($_POST["action"]) && $_POST["action"] == "update") {
        
        $statement = $bd->prepare(
            "UPDATE utilisateurs
            SET password = :password WHERE login = :login"
        );

        $statement->execute(
            array(
                ':password' => sha1($_POST["nouveau"]),
                ':login'       => $_POST["user"] 
            ));

        echo json_encode("OK");
    }

?>