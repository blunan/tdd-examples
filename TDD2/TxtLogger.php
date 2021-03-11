<?php

namespace TDD2;

require 'LogInterface.php';


class TxtLogger implements Log {

	private $file;

	public function __construct($file) {
		$this->file = $file;
		fclose(fopen($file, "a"));
	}

	private function write($message) {
		$log = fopen($this->file, "a");
		fwrite($log, $message);
		fclose($log);
	}

	public function readLogWithTag($tag = ""): String {
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

	public function writeLogWithTag($tag , $message): void {
		$this->write($tag . ": " . $message . "\n");
	}

	public function writeLog($message): void {
		$this->write($message . "\n");
	}

	public function readLog(): String {
		return $this->readLogWithTag();
	}
}