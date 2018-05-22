<?php
	/*
		HTMLPage Class [htmlpage.php]
		Handles header and footer of a page, assisting in creating full HTML file.
	*/

	require_once($_SERVER['DOCUMENT_ROOT'] . '/system/core.php');

	class HTMLPage {
		// page configuration
		private $post_title = " | Acadia Visitor Tracking";
		private $icon = "bhvt.ico";
		private $title = "";
		private $page_headers = "";
		private $onload = "";

		// setup new page
		function __construct($title) { $this->title = $title; }
		function __destruct() {}

		// start the html document output
		function document_start() {
			$this->title .= $this->post_title;
			echo "<!DOCTYPE html><html>";
			global $_CONFIG;
			require_once($_CONFIG['FILE']['ROOT_DIR'] . "/system/htmlres/head.php");
		}

		// terminate the html document output
		function document_end() { echo "</body></html>"; }

		// page configuration
		function set_post_title($pre_title) { $this->post_title = $post_title; }
		function set_title($title) { $this->title = $title; }
		function set_icon($filename) { $this->icon = $filename; }

		function set_headers($headers) { $this->page_headers = $headers; }
		function set_onload($onload) { $this->onload = $onload; }

		function add_header($header) { $this->page_headers .= $header; }
		function add_onload($function) { $this->onload .= $function; }

		// includes/imports
		function import_element($name) {
			$this->page_headers .= "<!-- $name -->";
			$this->page_headers .= "<link rel='stylesheet' type='text/css' href='/system/elements/$name/style.css'>";
			$this->page_headers .= "<script type='text/javascript' src='/system/elements/$name/script.js'></script>";
		}

		function include_system_stylesheet($name) {
			$this->page_headers .= "<link rel='stylesheet' type='text/css' href='/system/stylesheets/$name.css'>";
		}

		function include_system_script($name, $location) {
			$this->page_headers .= "<script type='text/javascript' src='/system/scripts/$location/$name.js'></script>";
		}

		function include_iface_stylesheet($name, $interface) {
			$this->page_headers .= "<link rel='stylesheet' type='text/css' href='/interfaces/$interface/style/$name.css'>";
		}

		function include_iface_script($name, $interface) {
			$this->page_headers .= "<script type='text/javascript' src='/interfaces/$interface/scripts/$name.js'></script>";
		}
	}
?>
