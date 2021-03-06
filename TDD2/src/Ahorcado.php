<?php

namespace TDD2;

class Ahorcado {

	private $word;
	private $logger;
	private $gameId;
	private $maxTries;
	private $triedLetters = [];

	public function __construct($word, $maxTries, Log $logger = null) {
		$this->logger = $logger;
		$this->gameId = uniqid();
		$this->maxTries = $maxTries;
		$this->word = str_split($word);
		
		$this->log("Comenzando un nuevo juego");
		$this->log("Palabra secreta: " . $word);
		$this->log("Intentos disponibles: " . $maxTries);
	}

	private function log($message) {
		if($this->logger != null) {
			$this->logger->writeLogWithTag($this->gameId, $message);
		}
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
		$this->log($output);
		return $output;
	}

	/*
	 * -1 Letra errornea
	 *  0 Letra ya usada
	 *  1 LEtra valida
	*/
	public function tryLetter($letter) {
		if($this->isLetterIgnoreCaseInArray($letter, $this->triedLetters)) {
			$this->log("La letra '" . $letter . "' ya se había intentado anteriormente");
			return 0;
		}
		$this->triedLetters[] = $letter;
		if(!$this->isLetterIgnoreCaseInArray($letter, $this->word)) {
			$this->log("La letra '" . $letter . "' no se encuentra en la palabra secreta");
			return -1;
		}
		$this->log("El jugador acierta la letra: " . $letter);
		return 1;
	}

	public function hasWon() {
		$lettersToGuess = count($this->word);
		foreach ($this->word as $letter) {
			if($this->isLetterIgnoreCaseInArray($letter, $this->triedLetters)) {
				$lettersToGuess--;
			}
		}
		if($lettersToGuess == 0) {
			$this->log("El jugador ha ganado");
		}
		return $lettersToGuess == 0;
	}

	public function hasLost() {
		if($this->getTriesLeft() > 0) {
			return false;
		} else {
			$this->log("El jugador ha perdido");
			return true;
		}
	}

	public function getGameId() {
		return $this->gameId;
	}
}