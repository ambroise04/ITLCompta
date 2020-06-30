<?php
    try
    {
        $bd = mysqli_connect("localhost","root","root","bditlcompta"); //new PDO('mysql:host=localhost;dbname=bditlcompta', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    
?>