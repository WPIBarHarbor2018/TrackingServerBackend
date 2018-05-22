<?php
	/*
		SQL Class [sql.php]
		A wrapper class for SQL database functions.
	*/

	require_once($_SERVER['DOCUMENT_ROOT'] . '/system/core.php');
	// _include('log');

	class SQL {
		var $mysqli;
		var $db;

		// constructors and destructors

		function __construct($username, $password, $db) {
			$this->db = $db;

			$this->mysqli = new mysqli('localhost', $username, $password, $this->db);

			if ($this->mysqli->connect_error) {
				// log_error("SQL Connection", $this->mysqli->connect_errno, $this->mysqli->connect_error);
				die('Connection Error (' . $this->mysqli->connect_errno . ') : ' . $this->mysqli->connect_error);
			}

			// log_system_event("SQL Connection", "Connected to database '$this->db' successfully using user name '$username'.");
		}

		function __destruct() { $this->mysqli->close(); }

		// query functions

		function query($query) {
			$result = $this->mysqli->query($query);

			if ($result === false) {
				// log_error("SQL Query: $query", $this->mysqli->errno, $this->mysqli->error);
				return false;
				//die('mySQLi Error (' . $this->mysqli->errno . ') : ' . $this->mysqli->error);
			}

			return $result;
		}

		function array_query($query) {
			$result = $this->mysqli->query($query);

			if ($result === false) {
				// log_error("SQL Query: $query", $this->mysqli->errno, $this->mysqli->error);
				return false;
				//die('mySQLi Error (' . $this->mysqli->errno . ') : ' . $this->mysqli->error);
			}

			$array = $result->fetch_array();

			if ($array === false) {
				// log_error("SQL Array Fetch From: $query", $this->mysqli->errno, $this->mysqli->error);
				return false;
				//die('mySQLi Error (' . $this->mysqli->errno . ') : ' . $this->mysqli->error);
			}

			return $array;
		}

		// utility functions

		function sanitize($query) { return $this->mysqli->real_escape_string($query); }

		// disconnect manually
		function close() { $this->mysqli->close(); }

		// get the object
		function get() { return $this->mysqli; }
	}
?>
