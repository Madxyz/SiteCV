<?php

// SI retour de formulaire

if (count($_POST) > 0)
{
    // logger (__FILE__." retour de formulaire ".  pwrint_r ($_POST, TRUE));
    $mode=$_POST ["mode"];
}
// SINON entr�e directe pour modification
elseif (isset ($_GET ["id_auteur"]))
{
    $myID=$_GET ["id_auteur"];
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
        $myID = ajouterAuteur ($_POST);

    case "R":
        $monAuteur = listerAuteur ($myID);
        $mode="U";
        break;

    case "U":
        modifierAuteur ($_POST);
        $monAuteur = listerAuteur ($_POST ["id_auteur"]);
        break;

    case "D":
        supprimerAuteur ($_POST ["id_auteur"]);

    default:
        $mode="C";
        $monAuteur = NULL;
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
        name: 'typeahead_auteur',
        remote:'search_Aut.php?key=%QUERY',
        minLength: 2,
        limit : 10
      }
    );
  });
</script>
<p><?php echo $verbe; ?> un Auteur</p>

<!-- (id_illustrateur, prenom_illustrateur, nom_illustrateur) -->

<form method="post">
    <input type="hidden" name="mode" value="<?php echo donnerValeur ("mode", $monAuteur, $mode); ?>">
    <input type="hidden" name="id_auteur" value="<?php echo donnerValeur ("id_auteur", $monAuteur); ?>">

    <table>
        <tr>
            <td>Nom de l'auteur</td>
            <td><input type="text" name="nom_auteur" value="<?php echo donnerValeur("nom_auteur", $monAuteur);?>"></td>
        </tr>
        <tr>
            <td>Prénom</td>
            <td><input type="text" name="prenom_auteur" value="<?php echo donnerValeur("prenom_auteur", $monAuteur);?>"></textarea></td>
        </tr>
    </table>

    <input type="submit" name="OK" value="Valider">

    
    <div class="bs-example">
        <input type="text" name="typeahead_auteur" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Nom de l'auteur">
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
    echo faireA ("?contexte=auteur", "Liste des auteurs de jeux de sociétés ");
    $mesAuteurs = listerAuteurs ();
	if (count ($mesAuteurs) == 0)
	{
		echo "Il n'y a pas d'Auteur!", PHP_EOL;
	}
	else
	{
		// ajout colonnes Action
		foreach ($mesAuteurs as & $auteur)
		{
			$auteur ["action"] = faireA ("?contexte=auteur&id_auteur=".$auteur["id_auteur"], "Modifier");
		}
		printTable ($mesAuteurs);
	}
?>