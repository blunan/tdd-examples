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

	public function testReadLogQuery() {
		$mockDataBase = $this->createMock(\PDO::class);
		$logger = new DataBaseLogger($mockDataBase);

		$mockPDOStatement = $this->createMock(\PDOStatement::class);

		$mockDataBase->expects($this->once())
			->method('query')
			->with('SELECT tag, log_message FROM logs;')
			->will($this->returnValue($mockPDOStatement));
		
		$mockPDOStatement->expects($this->once())
			->method('fetchAll')
			->will($this->returnValue([]));
		
		$this->assertEmpty($logger->readLog());
	}

	public function testReadLogResults() {
		$logger = new DataBaseLogger(new \PDO('sqlite::memory:'));
		
		$logger->writeLog("Este es un mensaje de prueba");

		$this->assertSame("Este es un mensaje de prueba\n", $logger->readLog());
	}

	public function testReadLogReuseDataBase() {
		if (file_exists('test.db')) {
			unlink('test.db');
		}
		$loggerA = new DataBaseLogger(new \PDO('sqlite:test.db'));
		$loggerA->writeLog("Este es un mensaje de prueba");


		$loggerB = new DataBaseLogger(new \PDO('sqlite:test.db'));
		$loggerB->writeLog("Este es otro log de prueba");

		$this->assertSame("Este es un mensaje de prueba\nEste es otro log de prueba\n", $loggerB->readLog());

		unlink('test.db');
	}

	public function testWriteLogWithTag() {
		$mockDataBase = $this->createMock(\PDO::class);
		$logger = new DataBaseLogger($mockDataBase);
		
		$mockDataBase->expects($this->once())
			->method('exec')
			->with('INSERT INTO logs (tag, log_message) VALUES ("TAG", "Este es un mensaje de prueba");');
		
		$logger->writeLogWithTag("TAG", "Este es un mensaje de prueba");
	}

	public function testReadLogWithTagQuery() {
		$mockDataBase = $this->createMock(\PDO::class);
		$logger = new DataBaseLogger($mockDataBase);

		$mockPDOStatement = $this->createMock(\PDOStatement::class);

		$mockDataBase->expects($this->once())
			->method('query')
			->with('SELECT tag, log_message FROM logs WHERE tag = "ALGO";')
			->will($this->returnValue($mockPDOStatement));
		
		$mockPDOStatement->expects($this->once())
			->method('fetchAll')
			->will($this->returnValue([]));
		
		$this->assertEmpty($logger->readLogWithTag("ALGO"));
	}

	public function testReadLogWithTagResults() {
		$logger = new DataBaseLogger(new \PDO('sqlite::memory:'));
		
		$logger->writeLogWithTag("GAME_ID", "Este es un mensaje de prueba");

		$this->assertSame("GAME_ID: Este es un mensaje de prueba\n", $logger->readLogWithTag("GAME_ID"));
	}
}