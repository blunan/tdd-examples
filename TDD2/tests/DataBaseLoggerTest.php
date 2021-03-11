<?php

namespace TDD2;

require __DIR__.'/../src/DataBaseLogger.php';

class DataBaseLoggerTest extends \PHPUnit\Framework\TestCase {

	public function testCreateTableOnConstruct() {
		$mockDataBase = $this->createMock(\PDO::class);
		$logger = new DataBaseLogger($mockDataBase);

		$mockDataBase->expects($this->once())
			->method('exec')
			->with('CREATE TABLE IF NOT EXISTS logs (
				id INTEGER PRIMARY KEY,
				tag TEXT,
				log_message TEXT NOT NULL
			);');
	}

}