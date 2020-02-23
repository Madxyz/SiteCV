<?php

// SI retour de formulaire

if (count($_POST) > 0)
{
    // logger (__FILE__." retour de formulaire ".  pwrint_r ($_POST, TRUE));
    $mode=$_POST ["mode"];
}
// SINON entr�e directe pour modification
elseif (isset ($_GET ["id_illustrateur"]))
{
    $myID=$_GET ["id_illustrateur"];
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
        $myID = ajouterIllustrateur ($_POST);

    case "R":
        $monIllustrateur = listerIllustrateur ($myID);
        $mode="U";
        break;

    case "U":
        modifierIllustrateur ($_POST);
        $monIllustrateur = listerIllustrateur ($_POST ["id_illustrateur"]);
        break;

    case "D":
        supprimerIllustrateur ($_POST ["id_illustrateur"]);

    default:
        $mode="C";
        $monIllustrateur = NULL;
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
        name: 'typeahead_illustrateur',
        remote:'search_Illu.php?key=%QUERY',
        minLength: 2,
        limit : 10
      }
    );
  });
</script>
<p><?php echo $verbe; ?> un illustrateur</p>

<!-- (id_illustrateur, prenom_illustrateur, nom_illustrateur) -->

<form method="post">
    <input type="hidden" name="mode" value="<?php echo donnerValeur ("mode", $monIllustrateur, $mode); ?>">
    <input type="hidden" name="id_illustrateur" value="<?php echo donnerValeur ("id_illustrateur", $monIllustrateur); ?>">

    <table>
        <tr>
            <td>Nom de l'illustrateur</td>
            <td><input type="text" name="nom_illustrateur" value="<?php echo donnerValeur("nom_illustrateur", $monIllustrateur);?>"></td>
        </tr>
        <tr>
            <td>Prénom</td>
            <td><input type="text" name="prenom_illustrateur" value="<?php echo donnerValeur("prenom_illustrateur", $monIllustrateur);?>"></textarea></td>
        </tr>
    </table>

    <input type="submit" name="OK" value="Valider">

    
    <div class="bs-example">
        <input type="text" name="typeahead_illustrateur" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Nom de l'illustrateur(rice)...">
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
    echo faireA ("?contexte=illustrateur", "Liste des illustrateurs de jeux de sociétés ");
    $mesIllustrateurs = listerIllustrateurs ();
	if (count ($mesIllustrateurs) == 0)
	{
		echo "Il n'y a pas d'Illustrateur!", PHP_EOL;
	}
	else
	{
		// ajout colonnes Action
		foreach ($mesIllustrateurs as & $illustrateur)
		{
			$illustrateur ["action"] = faireA ("?contexte=illustrateur&id_illustrateur=".$illustrateur["id_illustrateur"], "Modifier");
		}
		printTable ($mesIllustrateurs);
	}
?>