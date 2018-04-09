<?php
	include("./database/sql.php");

	/*
		Store data reported from the app into the database.
	*/
	function database_put($_id, $_time, $_latitude, $_longitude) {
		// create new SQL connection
		$db = new SQL($user, $pass, $db);

		// sanitize inputs to prevent SQL injection
		$id			= $db->sanitize($_id);
		$time		= $db->sanitize($_time);
		$latitude	= $db->sanitize($_latitude);
		$longitude	= $db->sanitize($_longitude);

		$db->query("INSERT INTO .......");
	}
?>
