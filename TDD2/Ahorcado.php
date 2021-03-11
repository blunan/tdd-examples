<?php

namespace TDD2;

class Ahorcado {

	private $word;
	private $gameId;
	private $maxTries;
	private $triedLetters = [];

	public function __construct($word, $maxTries) {
		$this->gameId = uniqid();
		$this->maxTries = $maxTries;
		$this->word = str_split($word);
	}

	private function isLetterIgnoreCaseInArray($letter, $array) {
		if(in_array(strtolower($letter), $array) || in_array(strtoupper($letter), $array)) {
			return true;
		} else {
			return false;
		}
	}

	public function getTriesLeft() {
		$triesLeft = $this->maxTries;
		foreach ($this->triedLetters as $letter) {
			if(!$this->isLetterIgnoreCaseInArray($letter, $this->word)) {
				$triesLeft--;
			}
		}
		return $triesLeft;
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
		return $output;
	}

	/*
	 * -1 Letra errornea
	 *  0 Letra ya usada
	 *  1 LEtra valida
	*/
	public function tryLetter($letter) {
		if($this->isLetterIgnoreCaseInArray($letter, $this->triedLetters)) {
			return 0;
		}
		$this->triedLetters[] = $letter;
		if(!$this->isLetterIgnoreCaseInArray($letter, $this->word)) {
			return -1;
		}
		return 1;
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
		return !($this->getTriesLeft() > 0);
	}

	public function getGameId() {
		return $this->gameId;
	}
}