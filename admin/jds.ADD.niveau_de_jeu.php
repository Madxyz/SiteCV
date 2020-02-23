<?php

// SI retour de formulaire

if (count($_POST) > 0)
{
    // logger (__FILE__." retour de formulaire ".  pwrint_r ($_POST, TRUE));
    $mode=$_POST ["mode"];
}
// SINON entr�e directe pour modification
elseif (isset ($_GET ["id_nv_de_jeu"]))
{
    $myID=$_GET ["id_nv_de_jeu"];
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
        $myID = ajouterNvDeJeu ($_POST);

    case "R":
        $monNvDeJeu = listerNvDeJeu ($myID);
        $mode="U";
        break;

    case "U":
        modifierNvDeJeu ($_POST);
        $monNvDeJeu = listerNvDeJeu ($_POST ["id_nv_de_jeu"]);
        break;

    case "D":
        supprimerNvDeJeu ($_POST ["id_nv_de_jeu"]);

    default:
        $mode="C";
        $monNvDeJeu = NULL;
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
        name: 'typeahead_nv',
        remote:'search_Aut.php?key=%QUERY',
        minLength: 2,
        limit : 10
      }
    );
  });
</script>
<p><?php echo $verbe; ?> un niveau de jeu</p>

<!-- (id_illustrateur, prenom_illustrateur, nom_illustrateur) -->

<form method="post">
    <input type="hidden" name="mode" value="<?php echo donnerValeur ("mode", $monNvDeJeu, $mode); ?>">
    <input type="hidden" name="id_nv_de_jeu" value="<?php echo donnerValeur ("id_nv_de_jeu", $monNvDeJeu); ?>">

    <table>
        <tr>
            <td>Valeur du niveau de jeu</td>
            <td><input type="text" name="valeur_nv_de_jeu" value="<?php echo donnerValeur("valeur_nv_de_jeu", $monNvDeJeu);?>"></td>
        </tr>
    </table>

    <input type="submit" name="OK" value="Valider">

    
    <div class="bs-example">
        <input type="text" name="typeahead_nv" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Niveau de jeu..">
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
    echo faireA ("?contexte=niveau_de_jeu", "Liste des differents niveau jeux de sociétés ");
    $mesNvDeJeux = listerNvDeJeux ();
	if (count ($mesNvDeJeux) == 0)
	{
		echo "Il n'y a pas de niveau de jeu!", PHP_EOL;
	}
	else
	{
		// ajout colonnes Action
		foreach ($mesNvDeJeux as & $nvDeJeu)
		{
			$nvDeJeu ["action"] = faireA ("?contexte=niveau_de_jeu&id_nv_de_jeu=".$nvDeJeu["id_nv_de_jeu"], "Modifier");
		}
		printTable ($mesNvDeJeux);
	}
?>