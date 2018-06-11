<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/system/core.php');
	_include('database');

	if (isset($_POST['req']) && ($req = $_POST['req'])) {
		switch($req) {
			case 'pageview':
				include("./htmlres/testpage.html");
				break;
			case "refresh_devices":
				break;
			case "refresh_data":
				break;
		}
	}
?>
