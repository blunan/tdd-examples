<?php

namespace TDD2;

class TxtLogger {

	private $log;

	public function __construct($file) {
		$this->log = fopen($file, "w");
	}

	public function write($message) {
		fwrite($this->log, $message);
	}
}