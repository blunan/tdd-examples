<?php
	namespace TDD1;

	require 'Ahorcado.php';

	$juego = new Ahorcado("Parangaricutirimicuaro", 8);

	while(!$juego->haGanado() && !$juego->haPerdido()) {
		echo "Adivina la palabra\n\n";
		echo $juego->show();
		echo "Introduce una letra: ";
		$letra = trim(fgets(STDIN));
		$juego->probarLetra($letra);
		echo "\n\n";
	}
	echo($juego->show());
	if($juego->haGanado()) {
		echo "Felicidades, haz ganado!!!\n\n";
	} else {
		echo "Lo siento, haz perdido.\n\n";
	}
?>