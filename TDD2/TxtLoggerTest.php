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
		$message = "Este es un log de preba";
	
		$logger->writeLog($message);
	
		$this->assertSame($message . "\n", $logger->readLogWithTag());
	}

	public function testWriteReuseLog() {
		$message = "Este es un log de prueba\n";
		$this->createDummyLogFile($message);
		$logger = new TxtLogger($this->logFile);
		$message2 = "Mensaje de prueba";
	
		$logger->writeLog($message2);
	
		$this->assertStringEqualsFile($this->logFile, $message . $message2 . "\n");
	}

	public function testReadLog() {
		$logger = new TxtLogger($this->logFile);
		$message1 = "Este es un log de preba";
		$message2 = "con dos registros";
	
		$logger->writeLog($message1);
		$logger->writeLog($message2);
	
		$this->assertEquals($message1 . "\n" . $message2 . "\n", $logger->readLog());
	}

	public function testReadReuseLog() {
		$message = "Este es un log de prueba\n";
		$this->createDummyLogFile($message);
		$logger = new TxtLogger($this->logFile);
		$message2 = "Mensaje de prueba";
	
		$logger->writeLog($message2);
	
		$this->assertSame($message . $message2 . "\n", $logger->readLogWithTag());
	}

	public function testWriteLogWithTag() {
		$logger = new TxtLogger($this->logFile);
		$message = "Mensaje de prueba";
		$tag = "TAG";
	
		$logger->writeLogWithTag($tag, $message);
	
		$this->assertSame($tag . ": " . $message . "\n", $logger->readLogWithTag());
	}

	public function testReadLogWithTag() {
		$message = "Este es un log de prueba\n";
		$this->createDummyLogFile($message);
		$logger = new TxtLogger($this->logFile);
		$message2 = "Mensaje de prueba";
		$tag = "TAG";
	
		$logger->writeLogWithTag($tag, $message2);
	
		$this->assertSame($tag . ": " . $message2 . "\n", $logger->readLogWithTag($tag));
	}
}