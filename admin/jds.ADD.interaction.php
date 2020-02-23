<?php

// SI retour de formulaire

if (count($_POST) > 0)
{
    // logger (__FILE__." retour de formulaire ".  pwrint_r ($_POST, TRUE));
    $mode=$_POST ["mode"];
}
// SINON entr�e directe pour modification
elseif (isset ($_GET ["id_interaction"]))
{
    $myID=$_GET ["id_interaction"];
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
        $myID = ajouterInteraction ($_POST);

    case "R":
        $monInteraction = listerInteraction ($myID);
        $mode="U";
        break;

    case "U":
        modifierInteraction ($_POST);
        $monInteraction = listerInteraction ($_POST ["id_interaction"]);
        break;

    case "D":
        supprimerInteraction ($_POST ["id_interaction"]);

    default:
        $mode="C";
        $monInteraction = NULL;
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
        name: 'typeahead_interaction',
        remote:'search_Inter.php?key=%QUERY',
        minLength: 2,
        limit : 10
      }
    );
  });
</script>
<p><?php echo $verbe; ?> une interaction</p>

<!-- (id_illustrateur, prenom_illustrateur, nom_illustrateur) -->

<form method="post">
    <input type="hidden" name="mode" value="<?php echo donnerValeur ("mode", $monInteraction, $mode); ?>">
    <input type="hidden" name="id_interaction" value="<?php echo donnerValeur ("id_interaction", $monInteraction); ?>">


    <table>
        <tr>
            <td>Nom de l'interaction</td>
            <td><input type="text" name="nom_interaction" value="<?php echo donnerValeur("nom_interaction", $monInteraction);?>"></td>
        </tr>
    </table>

    <input type="submit" name="OK" value="Valider">

    <div class="bs-example">
        <input type="text" name="typeahead_interaction" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Type d'interaction...">
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
    echo faireA ("?contexte=interaction", "Liste des intéractions de jeux de sociétés ");
    $mesInteractions = listerInteractions ();
	if (count ($mesInteractions) == 0)
	{
		echo "Il n'y a pas d'interaction!", PHP_EOL;
	}
	else
	{
		// ajout colonnes Action
		foreach ($mesInteractions as & $interaction)
		{
			$interaction ["action"] = faireA ("?contexte=interaction&id_interaction=".$interaction["id_interaction"], "Modifier");
		}
		printTable ($mesInteractions);
	}
?>