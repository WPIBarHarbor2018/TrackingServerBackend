<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/system/core.php');
	_include('database');

	if (isset($_POST['req']) && ($req = $_POST['req'])) {
		switch($req) {
			case 'refresh_system':
				$uptime = get_uptime();
				echo "<p>Server uptime is <b>{$uptime['days']}:{$uptime['hours']}:{$uptime['mins']}:{$uptime['secs']}</b></p>";
				echo "<p>Server hostname is <b>" . gethostname() . "</b></p>";
				echo "<p>Server IP is <b>{$_SERVER['SERVER_ADDR']}</b></p>";
				echo "<p>Reverse proxy server IP is <b>{$_SERVER['REMOTE_ADDR']}</b></p>";
				echo "<p>Reverse proxy server response time is <b>" . ping_domain($_SERVER['REMOTE_ADDR']) . " ms</b></p>";
				echo "<p>Internet response time is <b>" . ping_domain("1.1.1.1") . " ms</b></p>";
				break;
			case "refresh_devices":
				break;
			case "refresh_data":
				break;
		}
	}
?>
