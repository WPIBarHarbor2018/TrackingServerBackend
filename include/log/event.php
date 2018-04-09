<?php
	/*
		Event Class [event.php]
		A custom log event class.
	*/

	class Event {
		var $time;
		var $type;
		var $origin;
		var $errno;
		var $message;

		// constructors and destructors

		function __construct($time, $type, $origin, $message, $errno = null) {
			$this->time = $time;
			$this->type = $type;
			$this->origin = $origin;
			$this->message = $message;

			if ($errno !== null) {
				$this->errno = $errno;
			} else {
				$this->errno = false;
			}
		}

		function __destruct() {}

		// get functions

		function get_time() { return $this->time; }

        function get_type() { return $this->type; }

        function get_origin() { return $this->origin; }

        function get_message() { return $this->message; }

        function get_errno() { return $this->errno; }

        // generate string output of all data

        function get_event_string() {
            $t = strtoupper($this->type);
			$o = $this->origin;
            $datetime = DateTime::createFromFormat("U", $this->time);
			$datetime->setTimeZone(new DateTimeZone("America/New_York"));
			$d = $datetime->format("Y-m-d H:i:s");

			$m = str_replace("\t", '', $this->message);	// replace tabs with a space
			$m = str_replace("\n", ' ', $m);			// replace new lines with a space
			$m = str_replace("\r", ' ', $m);			// replace carriage returns a space

            return "[$t] [$d] [$o] $m\r\n";
        }

        function get_error_string() {
            if ($this->errno !== false) {
                $t = strtoupper($this->type);
				$o = $this->origin;
	            $datetime = DateTime::createFromFormat("U", $this->time);
				$datetime->setTimeZone(new DateTimeZone("America/New_York"));
				$d = $datetime->format("Y-m-d H:i:s");

                $m = str_replace("\t", '', $this->message);	// replace tabs with a space
                $m = str_replace("\n", ' ', $m);			// replace new lines with a space
                $m = str_replace("\r", ' ', $m);			// replace carriage returns a space

				$errno = $this->errno;

                return "[$t] [$d] [$o] [ERRNO=$errno] $m\r\n";
            } else {
                return false;
            }
        }
	}
?>
