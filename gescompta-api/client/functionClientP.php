<?php
	function get_total_all_records()
	{
		require("../connexionClassique.php");

		$statement = $bd->prepare("SELECT * FROM personnephysiques");
		
		$statement->execute();

		return $statement->rowCount();
	}

 ?>