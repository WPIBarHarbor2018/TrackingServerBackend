<?php
	if (isset($_POST['uuid']) && isset($_POST['times']) && isset($_POST['lats']) && isset($_POST['lons'])) {
		$uuid 			= $_POST['uuid'];
		$_times 		= $_POST['times'];
		$_latitudes 	= $_POST['lats'];
		$_longitudes 	= $_POST['lons'];

		require_once("../database.php");

		if (uuid_valid($uuid) === TRUE) {
			// explode into arrays
			$times 		= explode(",", $_times);
			$latitudes 	= explode(",", $_latitudes);
			$longitudes = explode(",", $_longitudes);

			if (count($times) == count($latitudes) && count($latitudes) == count($longitudes)) {
				// insert data into database
				for ($i = 0; i < count($times); $i++) {
					database_put_($uuid, $times[$i], $latitude[$i], $longitude[$i]);
				}
			} else {
				// malformed request
				http_response_code(400);
				exit(0);
			}
		} else {
			// not authorized
			http_response_code(401);
			exit(0);
		}
	} else {
		// malformed request
		http_response_code(400);
		exit(0);
	}
?>
