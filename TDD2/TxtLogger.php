<?php

namespace TDD2;

class TxtLogger {

	private $file;

	public function __construct($file) {
		$this->file = $file;
		fclose(fopen($file, "a"));
	}

	public function write($message) {
		$log = fopen($this->file, "a");
		fwrite($log, $message);
		fclose($log);
	}

	public function read() {
		$log = fopen($this->file, "r");
		$line = fgets($log);
		fclose($log);
		return $line;
	}
}