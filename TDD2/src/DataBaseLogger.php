<?php

namespace TDD2;

require 'LogInterface.php';

class DataBaseLogger implements Log {

	private $database;

	public function __construct(\PDO $database) {
		$this->database = $database;
		$this->database->exec('CREATE TABLE IF NOT EXISTS logs (id INTEGER PRIMARY KEY, tag TEXT, log_message TEXT NOT NULL);');
	}
	
	public function writeLog($message): void {
		$this->database->exec('INSERT INTO logs (log_message) VALUES ("' . $message . '");');
	}

	public function readLog(): String {
		$this->database->query('SELECT tag, log_message FROM logs');
		return "";
	}

	public function writeLogWithTag($tag , $message): void {
	}

	public function readLogWithTag($tag = ""): String {
		return "";
	}
}