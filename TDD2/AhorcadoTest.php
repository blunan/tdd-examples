<?php

namespace TDD2;

require 'Ahorcado.php';

class AhorcadoTest extends \PHPUnit\Framework\TestCase {

	public function testInicializar01() {
		$juego = new Ahorcado("Carreola", 5);

		$this->assertSame("_ _ _ _ _ _ _ _\nIntentos restantes: 5\n\n", $juego->show());
	}

	public function testInicializar02() {
		$juego = new Ahorcado("Perro", 4);

		$this->assertSame("_ _ _ _ _\nIntentos restantes: 4\n\n", $juego->show());
	}

	public function testAdivinarLetra() {
		$juego = new Ahorcado("Carreola", 5);

		$adivinoLetra_A = $juego->tryLetter('a');

		$this->assertSame("_ a _ _ _ _ _ a\nIntentos restantes: 5\n\n", $juego->show());
	}

	public function testAdivinarDosLetras() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->tryLetter('A');
		$juego->tryLetter('c');

		$this->assertSame("C a _ _ _ _ _ a\nIntentos restantes: 5\n\n", $juego->show());
	}

	public function testFallarLetra() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->tryLetter('p');

		$this->assertSame("_ _ _ _ _ _ _ _\nIntentos restantes: 4\n\n", $juego->show());
	}

	public function testFallarDosLetras() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->tryLetter('p');
		$juego->tryLetter('Z');

		$this->assertSame("_ _ _ _ _ _ _ _\nIntentos restantes: 3\n\n", $juego->show());
	}

	public function testGanar() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->tryLetter('C');
		$juego->tryLetter('a');
		$juego->tryLetter('r');
		$juego->tryLetter('e');
		$juego->tryLetter('o');
		$juego->tryLetter('l');

		$this->assertSame("C a r r e o l a\nIntentos restantes: 5\n\n", $juego->show());
	}

	public function testGanarConUnaFalla() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->tryLetter('Z');
		$juego->tryLetter('C');
		$juego->tryLetter('a');
		$juego->tryLetter('r');
		$juego->tryLetter('e');
		$juego->tryLetter('o');
		$juego->tryLetter('l');

		$this->assertSame("C a r r e o l a\nIntentos restantes: 4\n\n", $juego->show());
	}

	public function testHaGanado() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->tryLetter('C');
		$juego->tryLetter('a');
		$juego->tryLetter('r');
		$juego->tryLetter('e');
		$juego->tryLetter('o');
		$juego->tryLetter('l');

		$this->assertTrue($juego->hasWon());
	}

	public function testHaGanado2() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->tryLetter('C');
		$juego->tryLetter('a');
		$juego->tryLetter('r');
		$juego->tryLetter('e');
		$juego->tryLetter('o');

		$this->assertFalse($juego->hasWon());
	}

	public function testPerder() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->tryLetter('Z');
		$juego->tryLetter('P');
		$juego->tryLetter('M');
		$juego->tryLetter('B');
		$juego->tryLetter('X');

		$this->assertSame("_ _ _ _ _ _ _ _\nIntentos restantes: 0\n\n", $juego->show());
	}

	public function testPerderConUnAcierto() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->tryLetter('C');
		$juego->tryLetter('Z');
		$juego->tryLetter('P');
		$juego->tryLetter('M');
		$juego->tryLetter('B');
		$juego->tryLetter('X');

		$this->assertSame("C _ _ _ _ _ _ _\nIntentos restantes: 0\n\n", $juego->show());
	}

	public function testhaPerdido() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->tryLetter('Z');
		$juego->tryLetter('P');
		$juego->tryLetter('M');
		$juego->tryLetter('B');
		$juego->tryLetter('X');

		$this->assertTrue($juego->hasLost());
	}

	public function testhaPerdido2() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->tryLetter('Z');
		$juego->tryLetter('P');
		$juego->tryLetter('M');
		$juego->tryLetter('B');

		$this->assertFalse($juego->hasLost());
	}
}

?>