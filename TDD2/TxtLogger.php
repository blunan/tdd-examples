<?php

namespace TDD2;

class TxtLogger {

	private $file;

	public function __construct($file) {
		$this->file = $file;
		fclose(fopen($file, "w"));
	}

	public function writeLine($message, $tag = '') {
		$log = fopen($this->file, "a");
		if(!empty($tag)) {
			$tag .= ": ";
		}
		fwrite($log, $tag . $message . "\n");
		fclose($log);
	}
}