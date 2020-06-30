<?php
    try
    {
        $bd = new PDO('mysql:host=localhost;dbname=bditlcompta', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    
?>