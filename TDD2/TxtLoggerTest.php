<?php

namespace TDD2;

require 'TxtLogger.php';

class TxtLoggerTest extends \PHPUnit\Framework\TestCase {

	private $logFile = "test.log";

	protected function setUp(): void {
		if (file_exists($this->logFile)) {
			unlink($this->logFile);
		}
	}

	protected function createDummyLogFile($message) {
		$log = fopen($this->logFile, "w");
		fwrite($log, $message);
		fclose($log);
	}

	public function testInitializeNewLogFile() {
		$logger = new TxtLogger($this->logFile);

		$this->assertFileExists($this->logFile);
	}

	public function testInitializeReuseLogFile() {
		$message = "Este es un log de prueba";
		$this->createDummyLogFile($message);
		
		$logger = new TxtLogger($this->logFile);

		$this->assertStringEqualsFile($this->logFile, $message);
	}
}