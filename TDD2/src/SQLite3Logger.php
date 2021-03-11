<?php

namespace TDD2;

require 'LogInterface.php';

class SQLite3Logger implements Log {

	public function __construct(String $logDataBase) {
		$bd = new \SQLite3($logDataBase);
		$bd->close();
	}
	
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