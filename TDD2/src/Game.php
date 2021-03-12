<?php
	namespace TDD2;

	$logger = null;
	//require 'TxtLogger.php';
	//$logger = new TxtLogger("ahorcado.log");
	require 'DataBaseLogger.php';
	$logger = new DataBaseLogger(new \PDO('sqlite:ahoracdo.db'));

	require 'Ahorcado.php';
	$game = new Ahorcado("Parangaricutirimicuaro", 8, $logger);

	while(!$game->hasWon() && !$game->hasLost()) {
		echo "\n\nYour game ID is: " . $game->getGameId() . "\n\n";
		echo "Adivina la palabra\tIntentos restantes: " . $game->getTriesLeft() . "\n\n";
		echo $game->show() . "\n\n";
		echo "Introduce una letra: ";
		$letter = trim(fgets(STDIN));
		$result = $game->tryLetter($letter);
		if($result == -1) {
			echo "\nLa letra '" . $letter . "' no esta en la palabra, intenta con otra.\n";
		} else if ($result == 0) {
			echo "\nYa has intentado con la letra '" . $letter . "', intenta con otra.\n";
		}
	}
	echo "\n\nYour game ID is: " . $game->getGameId();
	echo "\n\n" . $game->show();
	if($game->hasWon()) {
		echo "\n\nFelicidades, haz ganado!!!\n\n";
	} else {
		echo "\n\nLo siento, haz perdido.\n\n";
	}
	if($logger != null) {
		echo "Quieres revisar tus jugadas? (y/n) : ";
		$letter = trim(fgets(STDIN));
		if($letter == 'y' || $letter == 'Y') {
			echo $logger->readLogWithTag($game->getGameId());
		}
	}
?>