<?php

namespace TDD2;

require __DIR__.'/../src/SQLite3Logger.php';

class SQLite3LoggerTest extends \PHPUnit\Framework\TestCase {

	private static $logDataBase = "test.sqlite3";

	protected function setUp(): void {
		if (file_exists(SQLite3LoggerTest::$logDataBase)) {
			unlink(SQLite3LoggerTest::$logDataBase);
		}
	}

	public static function tearDownAfterClass(): void {
		if (file_exists(SQLite3LoggerTest::$logDataBase)) {
			unlink(SQLite3LoggerTest::$logDataBase);
		}
	}

	public function testCreateNewDatabase() {
		$logger = new SQLite3Logger(SQLite3LoggerTest::$logDataBase);
	
		$this->assertFileExists(SQLite3LoggerTest::$logDataBase);
	}

	public function testCloseDatabaseConnectionOnDestruct() {
		$class = new \ReflectionClass('TDD2\SQLite3Logger');
		$method = $class->getMethod("replaceDataBase");
		$method->setAccessible(true);
		$logger = new SQLite3Logger(SQLite3LoggerTest::$logDataBase);
		$mockDataBase = $this->createMock(\SQLite3::class);
		$method->invokeArgs($logger, array($mockDataBase));

		$mockDataBase->expects($this->once())
			->method('close');
	}
}