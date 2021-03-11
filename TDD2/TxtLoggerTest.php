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

	public function testInitializeLogFile() {
		$logger = new TxtLogger($this->logFile);

		$this->assertFileExists($this->logFile);
	}

	public function testInitializeReuseLogFile() {
		$message = "Este es un log de prueba";
		$this->createDummyLogFile($message);

		$logger = new TxtLogger($this->logFile);

		$this->assertStringEqualsFile($this->logFile, $message);
	}

	public function testWriteLog() {
		$logger = new TxtLogger($this->logFile);
		$message = "Mensaje de prueba";
	
		$logger->write($message);
	
		$this->assertStringEqualsFile($this->logFile, $message);
	}

	public function testWriteReuseLog() {
		$message = "Este es un log de prueba";
		$this->createDummyLogFile($message);
		$logger = new TxtLogger($this->logFile);
		$message2 = "Mensaje de prueba";
	
		$logger->write($message2);
	
		$this->assertStringEqualsFile($this->logFile, $message . $message2);
	}

	public function testReadLog() {
		$logger = new TxtLogger($this->logFile);
		$message = "Mensaje de prueba";
	
		$logger->write($message);
	
		$this->assertSame($message, $logger->read());
	}

	public function testReadReuseLog() {
		$message = "Este es un log de prueba\n";
		$this->createDummyLogFile($message);
		$logger = new TxtLogger($this->logFile);
		$message2 = "Mensaje de prueba";
	
		$logger->write($message2);
	
		$this->assertSame($message . $message2, $logger->read());
	}

	public function testWriteLineWithTag() {
		$logger = new TxtLogger($this->logFile);
		$message = "Mensaje de prueba";
		$tag = "TAG";
	
		$logger->writeLine($tag, $message);
	
		$this->assertSame($tag . ": " . $message . "\n", $logger->read());
	}
}