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

	public function testInitializeTestLog() {
		$logger = new TxtLogger($this->logFile);

		$this->assertFileExists($this->logFile);
	}

	public function testWriteMessageToLog() {
		$logger = new TxtLogger($this->logFile);
		$message = "Mensaje de prueba";

		$logger->write($message);

		$this->assertStringEqualsFile($this->logFile, $message);
	}
}