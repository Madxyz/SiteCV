<?php

// SI retour de formulaire

if (count($_POST) > 0)
{
    // logger (__FILE__." retour de formulaire ".  pwrint_r ($_POST, TRUE));
    $mode=$_POST ["mode"];
}
// SINON entr�e directe pour modification
elseif (isset ($_GET ["id_categorie"]))
{
    $myID=$_GET ["id_categorie"];
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
        $myID = ajouterCategorie ($_POST);

    case "R":
        $monCategorie = listerCategorie ($myID);
        $mode="U";
        break;

    case "U":
        modifierCategorie ($_POST);
        $monCategorie = listerCategorie ($_POST ["id_categorie"]);
        break;

    case "D":
        supprimerCategorie ($_POST ["id_categorie"]);

    default:
        $mode="C";
        $monCategorie = NULL;
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
        name: 'typeahead_categorie',
        remote:'search_Cat.php?key=%QUERY',
        minLength: 2,
        limit : 10
      }
    );
  });
</script>
<p><?php echo $verbe; ?> un categorie</p>

<!-- (id_illustrateur, prenom_illustrateur, nom_illustrateur) -->

<form method="post">
    <input type="hidden" name="mode" value="<?php echo donnerValeur ("mode", $monCategorie, $mode); ?>">
    <input type="hidden" name="id_categorie" value="<?php echo donnerValeur ("id_categorie", $monCategorie); ?>">

    <table>
        <tr>
            <td>Nom de la categorie</td>
            <td><input type="text" name="nom_categorie" value="<?php echo donnerValeur("nom_categorie", $monCategorie);?>"></td>
        </tr>
    </table>

    <input type="submit" name="OK" value="Valider">

    
    <div class="bs-example">
        <input type="text" name="typeahead_categorie" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Nom de la catégorie">
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
    echo faireA ("?contexte=categorie", "Liste des catégories de jeux de sociétés ");
    $mesCategories = listerCategories ();
	if (count ($mesCategories) == 0)
	{
		echo "Il n'y a pas de categorie!", PHP_EOL;
	}
	else
	{
		// ajout colonnes Action
		foreach ($mesCategories as & $categorie)
		{
			$categorie ["action"] = faireA ("?contexte=categorie&id_categorie=".$categorie["id_categorie"], "Modifier");
		}
		printTable ($mesCategories);
	}
?>