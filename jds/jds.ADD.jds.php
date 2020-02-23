<?php

    $mesjds = listerjdss ();
	if (count ($mesjds) == 0)
	{
		echo "Il n'y a pas de jds!", PHP_EOL;
	}
	else
	{
		printTable ($mesjds);
	}

?>