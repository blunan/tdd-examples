<?php

namespace TDD2;

require 'LogInterface.php';

class DataBaseLogger implements Log {

	public function __construct(\PDO $database) {
		$database->exec('CREATE TABLE IF NOT EXISTS logs (id INTEGER PRIMARY KEY, tag TEXT, log_message TEXT NOT NULL);');
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