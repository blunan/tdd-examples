<?php

namespace TDD2;

require 'Ahorcado.php';

class AhorcadoTest extends \PHPUnit\Framework\TestCase {

	public function testInitialize01() {
		$game = new Ahorcado("Carreola", 5);

		$this->assertSame(5, $game->getTriesLeft());
		$this->assertSame("_ _ _ _ _ _ _ _", $game->show());
	}

	public function testInitialize02() {
		$game = new Ahorcado("Perro", 4);

		$this->assertSame(4, $game->getTriesLeft());
		$this->assertSame("_ _ _ _ _", $game->show());
	}

	public function testTryOneCorrectLetter() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('a');

		$this->assertSame("_ a _ _ _ _ _ a", $game->show());
	}

	public function testTryTwoCorrectLetters() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('a');
		$game->tryLetter('C');

		$this->assertSame("C a _ _ _ _ _ a", $game->show());
	}

	public function testTryOneWrongLetter() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('p');

		$this->assertSame(4, $game->getTriesLeft());
		$this->assertSame("_ _ _ _ _ _ _ _", $game->show());
	}

	public function testTryOneLetterIgnoreCase() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('A');

		$this->assertSame("_ a _ _ _ _ _ a", $game->show());
	}

	public function testHasWonWithOneMistake() {
		$game = new Ahorcado("Perro", 3);

		$game->tryLetter('P');
		$game->tryLetter('C');
		$game->tryLetter('e');
		$game->tryLetter('r');
		$game->tryLetter('o');

		$this->assertSame(2, $game->getTriesLeft());
		$this->assertSame("P e r r o", $game->show());
	}

	public function testHasWon() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('C');
		$game->tryLetter('a');
		$game->tryLetter('r');
		$game->tryLetter('e');
		$game->tryLetter('o');
		$game->tryLetter('l');

		$this->assertTrue($game->hasWon());
	}

	public function testHasNotWon() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('C');
		$game->tryLetter('a');
		$game->tryLetter('r');
		$game->tryLetter('e');
		$game->tryLetter('o');

		$this->assertFalse($game->hasWon());
	}

	public function testHasLost() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('Z');
		$game->tryLetter('P');
		$game->tryLetter('M');
		$game->tryLetter('B');
		$game->tryLetter('X');

		$this->assertTrue($game->hasLost());
	}

	public function testHasLostWithOneRightGuess() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('C');
		$game->tryLetter('Z');
		$game->tryLetter('P');
		$game->tryLetter('M');
		$game->tryLetter('B');
		$game->tryLetter('X');

		$this->assertTrue($game->hasLost());
		$this->assertSame("C _ _ _ _ _ _ _", $game->show());
	}

	public function testHasNotLost() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('Z');
		$game->tryLetter('P');
		$game->tryLetter('M');
		$game->tryLetter('B');

		$this->assertFalse($game->hasLost());
	}

	public function testTryRightLetter() {
		$game = new Ahorcado("Carreola", 5);

		$this->assertEquals(1, $game->tryLetter('c'));
	}

	public function testTrySameLetter() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('c');

		$this->assertEquals(0, $game->tryLetter('c'));
	}

	public function testTryWrongLetterResult() {
		$game = new Ahorcado("Carreola", 5);

		$this->assertEquals(-1, $game->tryLetter('Z'));
	}

	/* ------------------------------------------------------------ */

	public function testCreateGameId() {
		$game = new Ahorcado("Carreola", 5);

		$this->assertNotEmpty($game->getGameId());
	}

	public function testDistinctGameIdForDistinctGames() {
		$game1 = new Ahorcado("Carreola", 5);
		$game2 = new Ahorcado("Carreola", 5);

		$this->assertNotEquals($game1->getGameId(), $game2->getGameId());
	}
}

?>