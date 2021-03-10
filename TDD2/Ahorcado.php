<?php

namespace TDD2;

class Ahorcado {

	private $word;
	private $triesLeft;
	private $triedLetters = [];

	public function __construct($word, $triesLeft) {
		$this->triesLeft = $triesLeft;
		$this->word = str_split($word);
	}

	private function isLetterIgnoreCaseInArray($letter, $array) {
		if(in_array(strtolower($letter), $array) || in_array(strtoupper($letter), $array)) {
			return true;
		} else {
			return false;
		}
	}

	public function show() {
		$output = array_map(function($letter) {
			if($this->isLetterIgnoreCaseInArray($letter, $this->triedLetters)) {
				return $letter;
			} else {
				return '_';
			}
		}, $this->word);
		$output = implode(" ", $output);
		$output .= "\nIntentos restantes: " . $this->triesLeft . "\n\n";
		return $output;
	}

	public function tryLetter($letter) {
		if($this->isLetterIgnoreCaseInArray($letter, $this->triedLetters)) {
			echo "\nYa has intentado con la letra '" . $letter . "', intenta con otra.\n";
		} else {
			$this->triedLetters[] = $letter;
			if(!$this->isLetterIgnoreCaseInArray($letter, $this->word)) {
				$this->triesLeft--;
				echo "\nLa letra '" . $letter . "' no esta en la palabra, intenta con otra.\n";
			}
		}
	}

	public function hasWon() {
		$lettersToGuess = count($this->word);
		foreach ($this->word as $letter) {
			if($this->isLetterIgnoreCaseInArray($letter, $this->triedLetters)) {
				$lettersToGuess--;
			}
		}
		return $lettersToGuess == 0;
	}

	public function hasLost() {
		return !($this->triesLeft > 0);
	}
}