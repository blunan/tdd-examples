<?php

namespace TDD1;

class Ahorcado {

	private $palabra;
	private $intentos;
	private $letrasIntentadas = [];

	public function __construct($palabra, $intentos) {
		$this->palabra = str_split($palabra);
		$this->intentos = $intentos;
	}

	private function isLettetIgnoreCaseInArray($letter, $array) {
		if(in_array(strtolower($letter), $array) || in_array(strtoupper($letter), $array)) {
			return true;
		} else {
			return false;
		}
	}

	public function show() {
		$output = array_map(function($a) {
			if($this->isLettetIgnoreCaseInArray($a, $this->letrasIntentadas)) {
				return $a;
			} else {
				return '_';
			}
		}, $this->palabra);
		$output = implode(" ", $output);
		$output .= "\nIntentos restantes: " . $this->intentos . "\n\n";
		return $output;
	}

	public function probarLetra($letra) {
		if($this->esLetraYaUsada($letra)) {
			echo "\nYa has intentado con la letra '" . $letra . "', intenta con otra.\n";
		} else {
			$this->letrasIntentadas[] = $letra;
			if($this->esLetraErronea($letra)) {
				$this->intentos--;
				echo "\nLa letra '" . $letra . "' no esta en la palabra, intenta con otra.\n";
			}
		}
	}

	private function esLetraYaUsada($letra) {
		if($this->isLettetIgnoreCaseInArray($letra, $this->letrasIntentadas)) {
			return true;
		}
		return false;
	}

	private function esLetraErronea($letra) {
		if(!$this->isLettetIgnoreCaseInArray($letra, $this->palabra)) {
			return true;
		}
		return false;
	}

	public function haGanado() {
		$letrasPorAdivinar = count($this->palabra);
		foreach ($this->palabra as $letra) {
			if($this->isLettetIgnoreCaseInArray($letra, $this->letrasIntentadas)) {
				$letrasPorAdivinar--;
			}
		}
		return $letrasPorAdivinar == 0;
	}

	public function haPerdido() {
		return !($this->intentos > 0);
	}
}