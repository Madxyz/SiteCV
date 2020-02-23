<?php
    $mesEditeurs = listerEditeurs ();
	if (count ($mesEditeurs) == 0)
	{
		echo "Il n'y a pas d'editeur!", PHP_EOL;
	}
	else
	{
		printTable ($mesEditeurs);
	}
?>