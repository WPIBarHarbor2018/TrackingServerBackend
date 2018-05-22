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

	function sql_connect() {
		global $bhiqp_db;

		$auth = get_auth_data();
		$bhiqp_db = new SQL($auth['SQL']['USER'], $auth['SQL']['PASS'], $auth['SQL']['DATABASE']);

		return $bhiqp_db;
	}

	function sql_disconnect() {
		global $bhiqp_db;
		return $bhiqp_db->close();
	}

	/*
		Store data reported from the app into the database.
	*/
	function database_put($_id, $_time, $_latitude, $_longitude) {
		// create new SQL connection
		global $bhiqp_db;
		sql_connect();

		// sanitize inputs to prevent SQL injection
		$id			= $bhiqp_db->sanitize($_id);
		$time		= $bhiqp_db->sanitize($_time);
		$latitude	= $bhiqp_db->sanitize($_latitude);
		$longitude	= $bhiqp_db->sanitize($_longitude);

		$db->query("INSERT INTO .......");
	}

?>
