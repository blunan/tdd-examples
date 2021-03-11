<?php

namespace TDD2;

require 'LogInterface.php';

class SQLite3Logger implements Log {

	private $dataBase;

	public function __construct($logDataBase) {
		$this->dataBase = new \SQLite3($logDataBase);
	}

	public function __destruct() {
		$this->dataBase->close();
	}

	// Only for testing
	private function replaceDataBase(\SQLite3 $newDataBase) {
		$this->dataBase->close();
		$this->dataBase = $newDataBase;
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