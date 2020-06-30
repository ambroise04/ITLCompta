<?php
    require("../connexionClassique.php");
    require("getTotalCredit.php");
    require("getTotalDebit.php");
    //$_POST["journal"] = 6; $_POST["debut"] = "16/08/2017"; $_POST["fin"] = "23/08/2017";
    if (isset($_POST["journal"]) && !empty($_POST["journal"])) {

        $output = array();
        $data = array();

        if (isset($_POST["debut"]) && !empty($_POST["debut"]) && isset($_POST["fin"]) && !empty($_POST["fin"])) {
            $output[totalDebit] = getTotalDebit($_POST["journal"],)
        }

    } 

?>