<?php
	/*
		Logging Functions [log.php]
		Manage system logs.
	*/

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

		if (!is_dir($dir)) {
			mkdir($dir, 0777, true);
		}

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
		$event = new Event(time(), "system", $origin, $message);

		write_log($event);
	}

    function log_report_event($origin, $message) {
		$event = new Event(time(), "account", $origin, $message);

		write_log($event);
	}

    function log_error($origin, $errno, $message) {
		$event = new Event(time(), "error", $origin, $message, intval($errno));

		write_log($event);
	}
?>
