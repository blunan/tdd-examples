<?php

namespace TDD2;

require 'LogInterface.php';


class TxtLogger implements Log {

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

	public function read($tag = "") {
		$log = fopen($this->file, "r");
		$result = "";
		while(!feof($log)) {
			$line = fgets($log);
			if(!empty($tag)) {
				if(strpos($line, $tag) === 0) {
					$result .= $line;
				}
			} else {
				$result .= $line;
			}
		  }
		fclose($log);
		return $result;
	}

	public function writeLine($tag , $message) {
		$this->write($tag . ": " . $message . "\n");
	}

	public function writeLog($message) {

	}

	public function readLog() {

	}

	public function writeLogWithTag($tag , $message) {

	}

	public function readLogWithTag($tag) {

	}
}