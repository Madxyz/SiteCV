<?php
    $mesInteractions = listerInteractions ();
	if (count ($mesInteractions) == 0)
	{
		echo "Il n'y a pas d'interaction!", PHP_EOL;
	}
	else
	{

		printTable ($mesInteractions);
	}
?>