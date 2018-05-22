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
?>
