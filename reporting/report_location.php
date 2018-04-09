<?php
	$id 		= $POST['id'];
	$time 		= $POST['time'];
	$latitude 	= $POST['lat'];
	$longitude 	= $POST['lon'];

	if ($id && $time && $latitude && $longitude) {
		require_once("../database.php");
		database_put($id, $time, $latitude, $longitude);
	}
?>
