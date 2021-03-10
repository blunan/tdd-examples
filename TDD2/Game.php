<?php
	namespace TDD2;

	require 'Ahorcado.php';

	$game = new Ahorcado("Parangaricutirimicuaro", 8);

	while(!$game->hasWon() && !$game->hasLost()) {
		echo "\n\nAdivina la palabra\n\n";
		echo $game->show();
		echo "Introduce una letra: ";
		$letter = trim(fgets(STDIN));
		$result = $game->tryLetter($letter);
		if($result == -1) {
			echo "\nLa letra '" . $letter . "' no esta en la palabra, intenta con otra.\n";
		} else if ($result == 0) {
			echo "\nYa has intentado con la letra '" . $letter . "', intenta con otra.\n";
		}
	}
	echo($game->show());
	if($game->haGanado()) {
		echo "Felicidades, haz ganado!!!\n\n";
	} else {
		echo "Lo siento, haz perdido.\n\n";
	}
?>