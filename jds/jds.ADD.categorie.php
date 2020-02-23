<?php

    $mesCategories = listerCategories ();
	if (count ($mesCategories) == 0)
	{
		echo "Il n'y a pas de categorie!", PHP_EOL;
	}
	else
	{
		printTable ($mesCategories);
	}
?>