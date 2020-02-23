<?php

    $mesNvDeJeux = listerNvDeJeux ();
	if (count ($mesNvDeJeux) == 0)
	{
		echo "Il n'y a pas de niveau de jeu!", PHP_EOL;
	}
	else
	{
		printTable ($mesNvDeJeux, array("class"=>"tableaubdd", "class"=>"container"));
	}
?>