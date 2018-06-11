<?php
	/*
		Core Functions [core.php]
	*/

	/* ~~~ Core Variables and Functions ~~~ */

	// create global config variable
	$_CONFIG = parse_ini_file("conf/bhiqp.ini", true);

	// system includes
	function _include($module) {
		global $_CONFIG;
		require_once($_CONFIG['FILE']['ROOT_DIR'] . "/system/includes/$module/$module.php");
	}

	// authentication
	// returns a 2D associative array with sections and keys, then actual data
	function get_auth_data() {
		global $_CONFIG;
		return parse_ini_file($_CONFIG['FILE']['ROOT_DIR'] . "/system/conf/auth.ini", true);
	}

	// stand alone pages
	function generate_standalone_page($title = "", $header = "", $content) {
		global $_CONFIG;
		require_once($_CONFIG['FILE']['ROOT_DIR'] . "/system/htmlres/standalone.php");
	}

	/* ~~~ Utility Functions ~~~ */

	/*
		Truncate a string to be within the given length without breaking up words.
		https://stackoverflow.com/questions/3161816/get-first-n-characters-of-a-string#3161830
	*/
	function truncate($string, $length) {
		$string = trim($string);

		if(strlen($string) > $length) {
			$string = wordwrap($string, $length);
			$string = explode("\n", $string, 2);
			$string = $string[0];
		}

		return $string;
	}

	/*
		'Ping' a domain on port 80 and get response time.
		https://stackoverflow.com/questions/9841635/how-can-i-ping-a-server-port-with-php#9843251
	*/
	function ping_domain($domain) {
		$starttime = microtime(true);
		$file      = fsockopen ($domain, 80, $errno, $errstr, 10);
		$stoptime  = microtime(true);
		$status    = -1;

		if ($file) {
			// if response response
			fclose($file);
			$status = ($stoptime - $starttime) * 1000;
			$status = floor($status);
		}

		return $status;
	}

	/*
		Get server uptime.
	*/
	function get_uptime() {
		$str   = @file_get_contents('/proc/uptime');
		$num   = floatval($str);
		$secs  = sprintf('%02d', (int) fmod($num, 60));
		$num   = intdiv($num, 60);
		$mins  = sprintf('%02d', $num % 60);
		$num   = intdiv($num, 60);
		$hours = sprintf('%02d', $num % 24);
		$num   = intdiv($num, 24);
		$days  = $num;

		return array('days'  => $days,
				     'hours' => $hours,
				     'mins'  => $mins,
				     'secs'  => $secs);
	}
?>
