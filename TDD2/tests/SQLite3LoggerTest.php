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

	protected function tearDown(): void {
		$this->setUp();
	}

	public function testCreateNewDatabase() {
		$logger = new SQLite3Logger($this->logDataBase);
	
		$this->assertFileExists($this->logDataBase);
	}

	public function testCloseDatabaseConnectionOnDestruct() {
		$class = new \ReflectionClass('TDD2\SQLite3Logger');
		$method = $class->getMethod("replaceDataBase");
		$method->setAccessible(true);
		$logger = new SQLite3Logger($this->logDataBase);
		$mockDataBase = $this->createMock(\SQLite3::class);
		$method->invokeArgs($logger, array($mockDataBase));

		$mockDataBase->expects($this->once())
			->method('close');
	}
}