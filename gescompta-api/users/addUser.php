<?php

    require("../connexionClassique.php");
    
    if (isset($_POST["action"]) && $_POST["action"] == "add" ) {

        $statement = $bd->prepare('
            INSERT INTO utilisateurs (image, nom, prenom, login, password, email, actif, OnOff, idTypeUser)
            VALUES(:image, :nom, :prenom, :login, :password, :email, :actif, :OnOff, :idTypeUser)
        ');

        $image = $_POST["image"];
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $login = $_POST["login"];
        $password = $_POST["passe"];
        $email = $_POST["email"];
        $actif = 1;
        $OnOff = 1;
        $idTypeUser = $_POST["typeUser"];

        $result = $statement->execute(
            array(
                ':image'      =>    $image,
                ':nom'        =>    $nom,
                ':prenom'     =>    $prenom,
                ':login'      =>    $login,
                ':password'   =>    sha1($password),
                ':email'      =>    $email,
                ':actif'      =>    $actif,
                ':OnOff'      =>    $OnOff,
                ':idTypeUser' =>    $idTypeUser
            )
        );

        if (!empty($result)) {
            echo json_encode("OK");
        }
    }
?>