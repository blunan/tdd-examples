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

		$adivinoLetra_A = $juego->probarLetra('a');

		$this->assertSame("_ a _ _ _ _ _ a\nIntentos restantes: 5\n\n", $juego->show());
	}

	public function testAdivinarDosLetras() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->probarLetra('A');
		$juego->probarLetra('c');

		$this->assertSame("C a _ _ _ _ _ a\nIntentos restantes: 5\n\n", $juego->show());
	}

	public function testFallarLetra() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->probarLetra('p');

		$this->assertSame("_ _ _ _ _ _ _ _\nIntentos restantes: 4\n\n", $juego->show());
	}

	public function testFallarDosLetras() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->probarLetra('p');
		$juego->probarLetra('Z');

		$this->assertSame("_ _ _ _ _ _ _ _\nIntentos restantes: 3\n\n", $juego->show());
	}

	public function testGanar() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->probarLetra('C');
		$juego->probarLetra('a');
		$juego->probarLetra('r');
		$juego->probarLetra('e');
		$juego->probarLetra('o');
		$juego->probarLetra('l');

		$this->assertSame("C a r r e o l a\nIntentos restantes: 5\n\n", $juego->show());
	}

	public function testGanarConUnaFalla() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->probarLetra('Z');
		$juego->probarLetra('C');
		$juego->probarLetra('a');
		$juego->probarLetra('r');
		$juego->probarLetra('e');
		$juego->probarLetra('o');
		$juego->probarLetra('l');

		$this->assertSame("C a r r e o l a\nIntentos restantes: 4\n\n", $juego->show());
	}

	public function testHaGanado() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->probarLetra('C');
		$juego->probarLetra('a');
		$juego->probarLetra('r');
		$juego->probarLetra('e');
		$juego->probarLetra('o');
		$juego->probarLetra('l');

		$this->assertTrue($juego->haGanado());
	}

	public function testHaGanado2() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->probarLetra('C');
		$juego->probarLetra('a');
		$juego->probarLetra('r');
		$juego->probarLetra('e');
		$juego->probarLetra('o');

		$this->assertFalse($juego->haGanado());
	}

	public function testPerder() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->probarLetra('Z');
		$juego->probarLetra('P');
		$juego->probarLetra('M');
		$juego->probarLetra('B');
		$juego->probarLetra('X');

		$this->assertSame("_ _ _ _ _ _ _ _\nIntentos restantes: 0\n\n", $juego->show());
	}

	public function testPerderConUnAcierto() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->probarLetra('C');
		$juego->probarLetra('Z');
		$juego->probarLetra('P');
		$juego->probarLetra('M');
		$juego->probarLetra('B');
		$juego->probarLetra('X');

		$this->assertSame("C _ _ _ _ _ _ _\nIntentos restantes: 0\n\n", $juego->show());
	}

	public function testhaPerdido() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->probarLetra('Z');
		$juego->probarLetra('P');
		$juego->probarLetra('M');
		$juego->probarLetra('B');
		$juego->probarLetra('X');

		$this->assertTrue($juego->haPerdido());
	}

	public function testhaPerdido2() {
		$juego = new Ahorcado("Carreola", 5);

		$juego->probarLetra('Z');
		$juego->probarLetra('P');
		$juego->probarLetra('M');
		$juego->probarLetra('B');

		$this->assertFalse($juego->haPerdido());
	}
}

?>