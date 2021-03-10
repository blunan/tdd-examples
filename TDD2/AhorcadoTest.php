<?php

namespace TDD2;

require 'Ahorcado.php';

class AhorcadoTest extends \PHPUnit\Framework\TestCase {

	public function testInitialize01() {
		$game = new Ahorcado("Carreola", 5);

		$this->assertSame("_ _ _ _ _ _ _ _\nIntentos restantes: 5\n\n", $game->show());
	}

	public function testInitialize02() {
		$game = new Ahorcado("Perro", 4);

		$this->assertSame("_ _ _ _ _\nIntentos restantes: 4\n\n", $game->show());
	}

	public function testTryOneCorrectLetter() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('a');

		$this->assertSame("_ a _ _ _ _ _ a\nIntentos restantes: 5\n\n", $game->show());
	}

	public function testTryTwoCorrectLetters() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('a');
		$game->tryLetter('C');

		$this->assertSame("C a _ _ _ _ _ a\nIntentos restantes: 5\n\n", $game->show());
	}

	public function testTryOneWrongLetter() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('p');

		$this->assertSame("_ _ _ _ _ _ _ _\nIntentos restantes: 4\n\n", $game->show());
	}

	public function testTryTwoWrongLetters() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('p');
		$game->tryLetter('Z');

		$this->assertSame("_ _ _ _ _ _ _ _\nIntentos restantes: 3\n\n", $game->show());
	}

	public function testTryOneLetterIgnoeCase() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('A');

		$this->assertSame("_ a _ _ _ _ _ a\nIntentos restantes: 5\n\n", $game->show());
	}

	public function testTryTwoLettersIgnoeCase() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('A');
		$game->tryLetter('c');

		$this->assertSame("C a _ _ _ _ _ a\nIntentos restantes: 5\n\n", $game->show());
	}

	public function testHasWon01() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('C');
		$game->tryLetter('a');
		$game->tryLetter('r');
		$game->tryLetter('e');
		$game->tryLetter('o');
		$game->tryLetter('l');

		$this->assertSame("C a r r e o l a\nIntentos restantes: 5\n\n", $game->show());
	}

	public function testHasWonWithOneMistake() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('Z');
		$game->tryLetter('C');
		$game->tryLetter('a');
		$game->tryLetter('r');
		$game->tryLetter('e');
		$game->tryLetter('o');
		$game->tryLetter('l');

		$this->assertSame("C a r r e o l a\nIntentos restantes: 4\n\n", $game->show());
	}

	public function testHasWon02() {
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

	public function testHasLost01() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('Z');
		$game->tryLetter('P');
		$game->tryLetter('M');
		$game->tryLetter('B');
		$game->tryLetter('X');

		$this->assertSame("_ _ _ _ _ _ _ _\nIntentos restantes: 0\n\n", $game->show());
	}

	public function testHasLostWithOneRightGuess() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('C');
		$game->tryLetter('Z');
		$game->tryLetter('P');
		$game->tryLetter('M');
		$game->tryLetter('B');
		$game->tryLetter('X');

		$this->assertSame("C _ _ _ _ _ _ _\nIntentos restantes: 0\n\n", $game->show());
	}

	public function testHasLost02() {
		$game = new Ahorcado("Carreola", 5);

		$game->tryLetter('Z');
		$game->tryLetter('P');
		$game->tryLetter('M');
		$game->tryLetter('B');
		$game->tryLetter('X');

		$this->assertTrue($game->hasLost());
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