<?php

namespace TDD2;

require __DIR__.'/../src/TxtLogger.php';

class TxtLoggerTest extends \PHPUnit\Framework\TestCase {

	private static $logFile = "test.log";

	private $otherFile = "other.log";

	protected function setUp(): void {
		if (file_exists(TxtLoggerTest::$logFile)) {
			unlink(TxtLoggerTest::$logFile);
		}
	}

	public static function tearDownAfterClass(): void {
		if (file_exists(TxtLoggerTest::$logFile)) {
			unlink(TxtLoggerTest::$logFile);
		}
	}

	private function createDummyLogFile($message) {
		$log = fopen($this->otherFile, "w");
		fwrite($log, $message);
		fclose($log);
	}

	private function deleteDummyLogFile() {
		unlink($this->otherFile);
	}

	public function testWriteLog() {
		$logger = new TxtLogger(TxtLoggerTest::$logFile);
	
		$logger->writeLog("Este es un log de preba");
	
		$this->assertStringEqualsFile(TxtLoggerTest::$logFile, "Este es un log de preba\n");
	}

	public function testWriteReuseLog() {
		$this->createDummyLogFile("Este es un log de prueba\n");
		$logger = new TxtLogger($this->otherFile);
	
		$logger->writeLog("que ya tenía contenido");
	
		$this->assertStringEqualsFile($this->otherFile, "Este es un log de prueba\nque ya tenía contenido\n");

		$this->deleteDummyLogFile();
	}

	public function testReadLog() {
		$logger = new TxtLogger(TxtLoggerTest::$logFile);
	
		$logger->writeLog("Este es un log de preba");
	
		$this->assertEquals("Este es un log de preba\n", $logger->readLog());
	}

	public function testReadReuseLog() {
		$this->createDummyLogFile("Este es un log de prueba\n");
		$logger = new TxtLogger($this->otherFile);
	
		$logger->writeLog("que ya tenía contenido");
	
		$this->assertSame("Este es un log de prueba\nque ya tenía contenido\n", $logger->readLog());

		$this->deleteDummyLogFile();
	}

	public function testWriteLogWithTag() {
		$logger = new TxtLogger(TxtLoggerTest::$logFile);
	
		$logger->writeLogWithTag("TAG", "Mensaje de prueba");
	
		$this->assertSame("TAG: Mensaje de prueba\n", $logger->readLog());
	}

	public function testReadLogWithTag() {
		$logger = new TxtLogger(TxtLoggerTest::$logFile);
	
		$logger->writeLogWithTag("TAG", "Este es un log de prueba");
	
		$this->assertSame("TAG: Este es un log de prueba\n", $logger->readLogWithTag("TAG"));
	}
}