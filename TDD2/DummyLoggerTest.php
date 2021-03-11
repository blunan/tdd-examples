<?php

namespace TDD2;

require 'DummyLogger.php';

class DummyLoggerTest extends \PHPUnit\Framework\TestCase {

	public function testWriteLog() {
		$logger = new DummyLogger($this->logFile);
		$message = "Este es un log de preba";
	
		$logger->writeLog($message);
	
		$this->assertEmpty($logger->readLog());
	}

	public function testReadLog() {
		$logger = new DummyLogger($this->logFile);
		$message = "Mensaje de prueba";
		$tag = "TAG";
	
		$logger->writeLogWithTag($tag, $message);
	
		$this->assertEmpty($logger->readLog());
	}

	public function testWriteLogWithTag() {
		$logger = new DummyLogger($this->logFile);
		$message = "Mensaje de prueba";
		$tag = "TAG";
	
		$logger->writeLogWithTag($tag, $message);
	
		$this->assertEmpty($logger->readLogWithTag());
	}

	public function testReadLogWithTag() {
		$logger = new DummyLogger($this->logFile);
		$message = "Este es un log de preba";
	
		$logger->writeLog($message);
	
		$this->assertEmpty($logger->readLogWithTag($tag));
	}
}