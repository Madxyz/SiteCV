<?php

// SI retour de formulaire

if (count($_POST) > 0)
{
    // logger (__FILE__." retour de formulaire ".  pwrint_r ($_POST, TRUE));
    $mode=$_POST ["mode"];
}
// SINON entr�e directe pour modification
elseif (isset ($_GET ["id_mecanique"]))
{
    $myID=$_GET ["id_mecanique"];
    // logger (__FILE__. " modification de ". $myID);
    $mode="R";
}
// SINON cr�ation
else
{
    // logger (__FILE__. " cr�ation nouvel enregistrement");
    $mode="";
}

echo "Mode avant: $mode";

/* Gestion des actions */
switch ($mode)
{
    case "C":
        $myID = ajouterMecanique ($_POST);

    case "R":
        $monMecanique = listerMecanique ($myID);
        $mode="U";
        break;

    case "U":
        modifierMecanique ($_POST);
        $monMecanique = listerMecanique ($_POST ["id_mecanique"]);
        break;

    case "D":
        supprimerMecanique ($_POST ["id_mecanique"]);

    default:
        $mode="C";
        $monMecanique = NULL;
        $myID=NULL;
        break;
}

echo "Mode apres: $mode";

/* Gestion du titre */
switch ($mode)
{
    case "C":
        $verbe = "Ajouter";
        break;

    case "U":
        $verbe = "Modifier";
        break;
}


?>
<script>
  $(document).ready(function(){
    $('input.typeahead').typeahead(
      {
        name: 'typeahead_mecanique',
        remote:'search_Mec.php?key=%QUERY',
        minLength: 2,
        limit : 10
      }
    );
  });
</script>
<p><?php echo $verbe; ?> une mecanique</p>

<!-- (id_illustrateur, prenom_illustrateur, nom_illustrateur) -->

<form method="post">
    <input type="hidden" name="mode" value="<?php echo donnerValeur ("mode", $monMecanique, $mode); ?>">
    <input type="hidden" name="id_mecanique" value="<?php echo donnerValeur ("id_mecanique", $monMecanique); ?>">

    <table>
        <tr>
            <td>Nom de la mecanique</td>
            <td><input type="text" name="nom_mecanique" value="<?php echo donnerValeur("nom_mecanique", $monMecanique);?>"></td>
        </tr>
    </table>

    <input type="submit" name="OK" value="Valider">

    
    <div class="bs-example">
        <input type="text" name="typeahead_mecanique" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Mécanique...">
    </div>

<?php
    if ($mode == "U")
    {
?>
    <input type="submit" name="delete" value="Supprimer" onclick="return confirm ('Est-tu sur de vouloir supprimer de la bdd?') && (this.parentNode.mode.value='D');">
<?php
    }
?>
</form>

<?php
    echo faireA ("?contexte=mecanique", "Liste des mécaniques de jeux de sociétés ");
    $mesMecaniques = listerMecaniques ();
	if (count ($mesMecaniques) == 0)
	{
		echo "Il n'y a pas de mecanique!", PHP_EOL;
	}
	else
	{
		// ajout colonnes Action
		foreach ($mesMecaniques as & $mecanique)
		{
			$mecanique ["action"] = faireA ("?contexte=mecanique&id_mecanique=".$mecanique["id_mecanique"], "Modifier");
		}
		printTable ($mesMecaniques);
	}
?>