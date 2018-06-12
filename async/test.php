<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/system/core.php');
	_include('database');
	_include('uuid');
	_include('log');

	$err_origin = "bhiqp/async/test.php";
	global $bhiqp_db;
	sql_connect();

	if (isset($_POST['req']) && ($req = $_POST['req'])) {
		switch($req) {
			case 'pageview':
				include("./htmlres/testpage.html");
				break;
			case "newkey":
				$uuid = UUID::v4();
				$query = $bhiqp_db->query("INSERT INTO `test-keys` (`uuid`) VALUES ('$uuid')");

				if ($query === TRUE) {
					echo "UUID Created: $uuid";
					log_admin_event($err_origin, "Created new test UUID ($uuid).");
				} else {
					echo -1;
					log_error($err_origin, $bhiqp_db->errno, $bhiqp_db->error);
				}
				break;
			case "refresh_data":
				break;
		}
	}
?>
