<?php

// SI retour de formulaire

if (count($_POST) > 0)
{
    // logger (__FILE__." retour de formulaire ".  pwrint_r ($_POST, TRUE));
    $mode=$_POST ["mode"];
}
// SINON entr�e directe pour modification
elseif (isset ($_GET ["id_editeur"]))
{
    $myID=$_GET ["id_editeur"];
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
        $myID = ajouterEditeur ($_POST);

    case "R":
        $monEditeur = listerEditeur ($myID);
        $mode="U";
        break;

    case "U":
        modifierEditeur ($_POST);
        $monEditeur = listerEditeur ($_POST ["id_editeur"]);
        break;

    case "D":
        supprimerEditeur ($_POST ["id_editeur"]);

    default:
        $mode="C";
        $monEditeur = NULL;
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
        name: 'typeahead_editeur',
        remote:'search_Edit.php?key=%QUERY',
        minLength: 2,
        limit : 10
      }
    );
  });
</script>
<p><?php echo $verbe; ?> un editeur</p>

<!-- (id_illustrateur, prenom_illustrateur, nom_illustrateur) -->

<form method="post">
    <input type="hidden" name="mode" value="<?php echo donnerValeur ("mode", $monEditeur, $mode); ?>">
    <input type="hidden" name="id_editeur" value="<?php echo donnerValeur ("id_editeur", $monEditeur); ?>">

    <table>
        <tr>
            <td>Nom de l'editeur</td>
            <td><input type="text" name="nom_editeur" value="<?php echo donnerValeur("nom_editeur", $monEditeur);?>"></td>
        </tr>
    </table>

    <input type="submit" name="OK" value="Valider">

    
    <div class="bs-example">
        <input type="text" name="typeahead_editeur" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Nom de l'éditeur...">
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
    echo faireA ("?contexte=editeur", "Liste des éditeurs de jeux de sociétés ");
    $mesEditeurs = listerEditeurs ();
	if (count ($mesEditeurs) == 0)
	{
		echo "Il n'y a pas d'editeur!", PHP_EOL;
	}
	else
	{
		// ajout colonnes Action
		foreach ($mesEditeurs as & $editeur)
		{
			$editeur ["action"] = faireA ("?contexte=editeur&id_editeur=".$editeur["id_editeur"], "Modifier");
		}
		printTable ($mesEditeurs);
	}
?>