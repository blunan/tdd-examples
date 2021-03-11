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

	public function testInitializeNewLogFile() {
		$logger = new TxtLogger($this->logFile);

		$this->assertFileExists($this->logFile);
	}
}