<?php
	require "connexionBD.php";

    $output = array();
    
    //$_POST['login'] = "joel"; $_POST["passe"] = "kadaba";

    if(!empty($_POST['login']) && isset($_POST['login'])){

        extract($_POST);

        $requete = 'SELECT * FROM utilisateurs WHERE login=\''.$login.'\'';     

        $result = mysqli_query($bd, $requete);

        $row = mysqli_fetch_array($result); 

        $userPass = $row["password"];

    	if(!$row["login"] == ""){

    		if (sha1($passe) == $userPass) {

                $req = 'SELECT * FROM typeusers WHERE idTypeUser = \''.$row["idTypeUser"].'\'';
                $resultatType = mysqli_query($bd, $req);
                $ligne = mysqli_fetch_array($resultatType);


                $requete = '
                    INSERT INTO session (idUser, prenom, login, pw, type, state)
                    VALUES(\''.$row["idUser"].'\', \''.$row["prenom"].'\', \''.$row["login"].'\', \''.$row["password"].'\', \''.$ligne["libelleTypeUser"].'\', 1)
                ';
                $statement = mysqli_query($bd, $requete);
                
                if (!empty($tabSession)) {
                    echo json_encode("OK");
                }


                $output = array("response" => "CORRECT");

    		} else {

    			$output = array("response" => "WRONG_PASS");
    		}

    	} else {

    		$output = array("response" => "USER_NOT_FOUND");
    	}
	
	} else {

		$output = array("response" => "LOGIN_ERROR");
	} 
    echo json_encode($output);
?>

