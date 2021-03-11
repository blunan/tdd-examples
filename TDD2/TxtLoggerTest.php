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

	public function testWriteOneMessage() {
		$logger = new TxtLogger($this->logFile);
		$message = "Mensaje de prueba";

		$logger->writeLine($message);

		$this->assertStringEqualsFile($this->logFile, $message . "\n");
	}

	public function testWriteMessageWithTag() {
		$logger = new TxtLogger($this->logFile);
		$message = "Mensaje de prueba";
		$tag = "TAG";

		$logger->writeLine($message, $tag);

		$this->assertStringEqualsFile($this->logFile, $tag . ": " . $message . "\n");
	}
}