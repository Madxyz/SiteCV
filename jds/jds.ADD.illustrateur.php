<?php
    $mesIllustrateurs = listerIllustrateurs ();
	if (count ($mesIllustrateurs) == 0)
	{
		echo "Il n'y a pas d'Illustrateur!", PHP_EOL;
	}
	else
	{
		printTable ($mesIllustrateurs);
	}
?>