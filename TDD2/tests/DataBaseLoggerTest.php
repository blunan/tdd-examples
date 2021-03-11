<?php

namespace TDD2;

require __DIR__.'/../src/DataBaseLogger.php';

class DataBaseLoggerTest extends \PHPUnit\Framework\TestCase {

	public function testCreateTableOnConstruct() {
		$mockDataBase = $this->createMock(\PDO::class);
		$mockDataBase->expects($this->once())
			->method('exec')
			->with('CREATE TABLE IF NOT EXISTS logs (id INTEGER PRIMARY KEY, tag TEXT, log_message TEXT NOT NULL);');

		$logger = new DataBaseLogger($mockDataBase);
	}

	public function testWriteToLog() {
		$mockDataBase = $this->createMock(\PDO::class);
		$logger = new DataBaseLogger($mockDataBase);

		$mockDataBase->expects($this->once())
			->method('exec')
			->with('INSERT INTO logs (log_message) VALUES ("Este es un mensaje de prueba");');
		
		$logger->writeLog("Este es un mensaje de prueba");
	}
}