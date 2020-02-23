<?php

// SI retour de formulaire

if (count($_POST) > 0)
{
    // logger (__FILE__." retour de formulaire ".  pwrint_r ($_POST, TRUE));
    $mode=$_POST ["mode"];
}
// SINON entr�e directe pour modification
elseif (isset ($_GET ["id_jds"]))
{
    $myID=$_GET ["id_jds"];
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
        $myID = ajouterjds ($_POST);

    case "R":
        $monjds = listerjds ($myID);
        $mode="U";
        break;

    case "U":
        modifierjds ($_POST);
        $monjds = listerjds ($_POST ["id_jds"]);
        break;

    case "D":
        supprimerjds ($_POST ["id_jds"]);

    default:
        $mode="C";
        $monjds = NULL;
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
        name: 'typeahead',
        remote:'search_Jds.php?key=%QUERY',
        minLength: 2,
        limit : 10
      }
    );
  });
</script>
<p><?php echo $verbe; ?> un jeu de société</p>

<!-- (nom varchar(45),	description tinytext,	nombre_joueurs_min  tinyint(2),	nombre_joueurs_max  tinyint(2),	duree_partie tinyint(3),	note  decimal(2,2),
      avis  tinytext,	date_sortie  date,	age tinyint(3),	langue  varchar(45),	image	varchar(45)) -->

<form method="post">
    <input type="hidden" name="mode" value="<?php echo donnerValeur ("mode", $monjds, $mode); ?>">
    <input type="hidden" name="id_jds" value="<?php echo donnerValeur ("id_jds", $monjds); ?>">

    <table>
        <tr>
            <td>Nom du Jeu de société</td>
            <td><input type="text" name="nom" value="<?php echo donnerValeur("nom", $monjds);?>"></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea  rows="10" cols="50" name="description" value="<?php echo donnerValeur("description", $monjds);?>"></textarea></td>
        </tr>
        <tr>
            <td>Le nombre de joueurs</td>
            <td><input type="number" name="nombre_joueurs_min" value="<?php echo donnerValeur("nombre_joueurs_min", $monjds);?>"></td>
            <td><input type="number" name="nombre_joueurs_max" value="<?php echo donnerValeur("nombre_joueurs_max", $monjds);?>"></td>
        </tr>
        <tr>
            <td>Durée d'une partie</td>
            <td><input type="number" name="duree_partie" step="1" min="0" max="6000" value="<?php echo donnerValeur("duree_partie", $monjds);?>"></td>
        </tr>
        <tr>
            <td>Ma note</td>
            <td><input type="number" name="note" step="0.5" min="0" max="5" name="note" value="<?php echo donnerValeur("note", $monjds);?>"></td>
        </tr>
        <tr>
            <td>Mon avis</td>
            <td><textarea  rows="5" cols="50" name="avis" value="<?php echo donnerValeur("avis", $monjds);?>"></textarea></td>
        </tr>
        <tr>
            <td>Date de sortie du jeu</td>
            <td><input type="date" name="date_sortie" value="<?php echo donnerValeur("date_sortie", $monjds);?>"></td>
        </tr>
        <tr>
            <td>Âge suggéré</td>
            <td><input type="number" name="age" value="<?php echo donnerValeur("age", $monjds);?>"></td>
        </tr>
        <tr>
            <td>Langue</td>
            <td>
                <select name="langue">
                    <option value ="français">Français</option>
                    <option value ="anglais">Anglais</option>
                    <option value ="allemand">Allemand</option>
                    <option value ="autre">Autre</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Image</td>
            <td><input type="file" name="image" accept="image/png, image/jpeg" value="<?php echo donnerValeur("image", $monjds);?>"></td>
        </tr>
    </table>

    <input type="submit" name="OK" value="Valider">

    <div class="bs-example">
        <input type="text" name="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Nom du jeu...">
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
    echo faireA ("?contexte=jds", "Liste des jeux de sociétés ");
    $mesjds = listerjdss();
	if (count ($mesjds) == 0)
	{
		echo "Il n'y a pas de jds!", PHP_EOL;
	}
	else
	{
		// ajout colonnes Action
		foreach ($mesjds as & $jds)
		{
			$jds ["action"] = faireA ("?contexte=jds&id_jds=".$jds["id_jds"], "Modifier");
		}
		printTable ($mesjds);
	}

?>