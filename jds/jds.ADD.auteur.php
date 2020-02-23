<?php
    $mesAuteurs = listerAuteurs ();
	if (count ($mesAuteurs) == 0)
	{
		echo "Il n'y a pas d'Auteur!", PHP_EOL;
	}
	else
	{

		printTable ($mesAuteurs);
	}
?>