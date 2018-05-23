<?php
	/*
		Database Connection Functions [database.php]
		This file manages SQL connections and functions.
	*/

	require_once($_SERVER['DOCUMENT_ROOT'] . '/system/core.php');
	include('sql.php');

	// global references to database
	global $bhiqp_db;

	// database connection function

	/*
		Connect to the database.
	*/
	function sql_connect() {
		global $bhiqp_db;

		$auth = get_auth_data();
		$bhiqp_db = new SQL($auth['SQL']['USER'], $auth['SQL']['PASS'], $auth['SQL']['DATABASE']);

		return $bhiqp_db;
	}

	/*
		Disconnect from the database.
	*/
	function sql_disconnect() {
		global $bhiqp_db;
		return $bhiqp_db->close();
	}

	/*
		Store data reported from the app into the database.
	*/
	function database_put($_uuid, $_time, $_latitude, $_longitude) {
		// create new SQL connection
		global $bhiqp_db;
		sql_connect();

		// sanitize inputs to prevent SQL injection
		$uuid		= $bhiqp_db->sanitize($_uuid);
		$time		= $bhiqp_db->sanitize($_time);
		$latitude	= $bhiqp_db->sanitize($_latitude);
		$longitude	= $bhiqp_db->sanitize($_longitude);

		// insert data
		$bhiqp_db->query("INSERT INTO `gps-data` (`uuid`, `latitude`, `longitude`, `timestamp`) VALUES ('$uuid', $latitude, $longitude, $timestamp)");
	}

	/*
		Check if a UUID is valid (exists and is enabled).
	*/
	function uuid_valid($uuid) {

		return ;
	}

?>
