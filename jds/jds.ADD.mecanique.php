<?php

    $mesMecaniques = listerMecaniques ();
	if (count ($mesMecaniques) == 0)
	{
		echo "Il n'y a pas de mecanique!", PHP_EOL;
	}
	else
	{
		printTable ($mesMecaniques);
	}
?>