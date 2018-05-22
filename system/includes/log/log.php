<?php
	/*
		Logging Functions [log.php]
		Manage system logs.
	*/

	require_once($_SERVER['DOCUMENT_ROOT'] . '/system/core.php');
	require_once('event.php');

	function write_log($event){
		// get global config info
		global $_CONFIG;

		// get data from event
		$type = $event->get_type();
		$time = $event->get_time();
		$dt = DateTime::createFromFormat("U", $time);
		$dt->setTimeZone(new DateTimeZone($_CONFIG['HOST']['TIMEZONE']));
		$date = $dt->format("Y-m-d");

		$path = $_CONFIG['LOG']['LOG_DIR'] . "/$type/$date.log";
		$dir  = $_CONFIG['LOG']['LOG_DIR'] . "/$type";

		if (!is_dir($dir)) { mkdir($dir, 0777, true); }

		// open a file to append to
		$file = fopen($path,"a");

		if ($event->get_errno() !== false) {
			$log_text = $event->get_error_string();
		} else {
			$log_text = $event->get_event_string();
		}

		fwrite($file, $log_text);

		fclose($file);
	}

    function log_system_event($origin, $message) {
		write_log(new Event(time(), "system", $origin, $message));
	}

    function log_account_event($origin, $message) {
		write_log(new Event(time(), "account", $origin, $message));
	}

    function log_admin_event($origin, $message) {
		write_log(new Event(time(), "admin", $origin, $message));
	}

    function log_user_event($origin, $message) {
		write_log(new Event(time(), "user", $origin, $message));
	}

    function log_login_event($origin, $message) {
		write_log(new Event(time(), "login", $origin, $message));
	}

    function log_mail_event($origin, $message) {
		write_log(new Event(time(), "mail", $origin, $message));
	}

    function log_error($origin, $errno, $message) {
		write_log(new Event(time(), "error", $origin, $message, intval($errno)));
	}
?>