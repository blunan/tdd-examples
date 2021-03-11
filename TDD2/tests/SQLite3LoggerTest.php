<?php

namespace TDD2;

require __DIR__.'/../src/SQLite3Logger.php';

class SQLite3LoggerTest extends \PHPUnit\Framework\TestCase {

	private $logDataBase = "test.sqlite3";

	protected function setUp(): void {
		if (file_exists($this->logDataBase)) {
			unlink($this->logDataBase);
		}
	}

	public function testCreateNewDatabase() {
		$logger = new SQLite3Logger($this->logDataBase);
	
		$this->assertFileExists($this->logDataBase);
	}
}