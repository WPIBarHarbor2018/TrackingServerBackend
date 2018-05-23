<?php
	if (isset($_POST['uuid']) && isset($_POST['time']) && isset($_POST['lat']) && isset($_POST['lon'])) {
		$uuid 		= $_POST['uuid'];
		$time 		= $_POST['time'];
		$latitude 	= $_POST['lat'];
		$longitude 	= $_POST['lon'];

		require_once("../database.php");

		if (uuid_valid($uuid) === TRUE) {
			// insert data into database
			database_put($uuid, $time, $latitude, $longitude);
		} else {
			// not authorized
			http_response_code(401);
		}
	} else {
		// malformed request
		http_response_code(400);
		exit(0);
	}
?>
