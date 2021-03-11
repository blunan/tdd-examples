<?php

namespace TDD2;

class TxtLogger {

	private $file;

	public function __construct($file) {
		$this->file = $file;
		fclose(fopen($file, "a"));
	}

	public function write($message) {
		$log = fopen($this->file, "w");
		fwrite($log, $message);
		fclose($log);
	}
}