<?php

namespace TDD2;

require 'LogInterface.php';

class DataBaseLogger implements Log {
	
	public function writeLog($message): void {
	}

	public function readLog(): String {
		return "";
	}

	public function writeLogWithTag($tag , $message): void {
	}

	public function readLogWithTag($tag = ""): String {
		return "";
	}
}