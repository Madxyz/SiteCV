<?php

include 'jds.DB.php';

function faireAttributs($tabAttributs)
{
    $attributString = '';

    foreach ($tabAttributs as $nomAttribut => $valAttribut)
    {
        $attributString .= ' ' . $nomAttribut . '="' . $valAttribut . '"';
    }

    return $attributString;
}

function indenter ( $x = null )
{
    $tab = 4;
    $inc = 0;

    static $increment = 0;

    if (is_null($x))
    {
        $inc = $increment;
    }
    elseif ( $x )
    {
        $inc = $increment++;
    }
    elseif ( ! $x )
    {
        $inc = --$increment;
    }

    return str_repeat (" ", $inc * $tab );
}

function printListe($Table, $attributes = array())
{
    $att = faireAttributs($attributes);

    echo indenter(true), "<ul$att>", PHP_EOL;
    foreach ($Table as $Key => $Value)
    {
        echo indenter();
	if (is_array($Value))
	{
            echo "<li>$Key", PHP_EOL;
            indenter(true);
            printListe($Value);
            echo indenter(false);
	}
	else
            echo "<li>$Value";
        echo "</li>", PHP_EOL;
    }
    echo indenter(false), "</ul>", PHP_EOL;
}

function printListeWithKey ( $Table, $attributes = array() )
{
    $att = faireAttributs($attributes);
    echo indenter(true), "<ul$att>", PHP_EOL;
    foreach ($Table as $Key => $Value)
    {
        echo indenter();
        if (is_array($Value))
        {
                echo "<li>$Key", PHP_EOL;
                indenter(true);
                printListe($Value);
                echo indenter(false);
        }
        else
            echo "<li>", is_numeric ($Key)? "": $Key, $Value;
        echo "</li>", PHP_EOL;
    }
    echo indenter(false), "</ul>", PHP_EOL;
}

function printLigne($ligne ,$premiereLigne = false)
{
    echo indenter(true), "<tr>", PHP_EOL;
    $tagcell = $premiereLigne ? "th" : "td";

    foreach ($ligne as $nomColonne => $valeurColonne)
    {
        echo indenter(), "<", $tagcell, ">",
                        ($premiereLigne ? $nomColonne : $valeurColonne),
                        "</", $tagcell, ">", PHP_EOL;
    }
    echo indenter(false), "</tr>", PHP_EOL;
}

function printTable($Table, $attributsTable = array())
{
    /* static $Key = 0; */
    /* $id = "Table" . ++$Key; */
    $premiereLigne = true;

    echo indenter(true), "<table", faireAttributs($attributsTable), ">";

    foreach ($Table as $ligne)
    {
	if ($premiereLigne)
	{
            printLigne($ligne, $premiereLigne);
            $premiereLigne = false;
        }
        printLigne($ligne);
    }
    echo indenter(false), "</table>", PHP_EOL;
}

function ecrireFichier($NomFichier, $Text)
{
    $Fichier = fopen($NomFichier, "a");
    fwrite($Fichier, $Text);
    fclose($Fichier);
}

function logger($ca, $file = "trace.log")
{
    /* $now = new DateTime::format("Y/m/j - H:i:s,uv"); */
    //$now = Date("Y/m/j - H:i:s,uv", microtime(true));

    $seconds = explode(".", microtime(true));
    $now =  Date("Y-m-j - H:i:s,", $seconds[0]) . str_pad($seconds[1], 6, "0", STR_PAD_LEFT);

    /* $date = DateTime::createFromFormat('U.u', microtime(TRUE));
    $now = $date->format('Y-m-d H:i:s.u'); */
    ecrireFichier($file, $now . $ca . PHP_EOL);
}

function estEntreeValide ($Champ, $Tableau) 
{
    // Si $Tableau est bien un tableau et que l'entrée "Champ" existe dans "Tableau" et qu'elle n'est pas vide ou égale à "null" => return true; sinon false.
    if ( is_array($Tableau) 
      && array_key_exists ($Champ, $Tableau) 
      && $Tableau[$Champ] !== '' 
      && $Tableau[$Champ] !== null) 
	return true;
    return false;
}

function sontEntreeValide ($Champs, $Tableau) 
{
    $result = true;
    // Si les deux parametres sont bien des tableau => on verifie que $Tableau ai les champs de
    // Champs et si ils ne sont ni vide ni égal à "null"
    if ( is_array ($Tableau) && is_array ($Champs)) 
    {
	foreach ( $Champs as $Champ) 
	{
            if ( !array_key_exists($Champ, $Tableau) 
                || $Tableau[$Champ] === ''
                || $Tableau[$Champ] === null ) $result = false;
        }
    }
    return $result;
}

function faireA ($url, $titre, $attributs = array()) 
{
    $attributs["href"]= $url;
    $tag = "<a " . faireAttributs($attributs) . ">" . $titre . "</a>";
    return $tag;
}

function faireTableauxAncres ($donnees) 
{
    $AncresArray = array();

    foreach ($donnees as $Value) 
    {
        $AncresArray[] = faireA($Value['URL'], $Value['titre']);
    }
    return $AncresArray;
}

function lireFichier($nomFichier) 
{
    $contenuFichier = file($nomFichier, FILE_IGNORE_NEW_LINES);
    $premiereLigne = true;
    $DATA = array();

    foreach ($contenuFichier as $ligne) 
    {
        $x = explode (';', $ligne);

        if ($premiereLigne) 
        {
                $description = $x;
                $premiereLigne = false;
        } 
        else 
        {
            $maLigne = array();
            foreach ($description as $numeroColonne => $nomColonne) 
            {
                    $maLigne[$nomColonne] = $x[$numeroColonne];
            }
            $DATA[] = $maLigne;
        }
    }

    return $DATA;
}

function faireTableauImages($dossier) 
{
    $listeImages = scandir($dossier);
    $images = array ();
    foreach($listeImages as $IMAGE) 
    {
	if($IMAGE[0] !== ".") 
	{
            $images[] = new ImageMini ("./$dossier/$IMAGE");
        }
    }

    return $images;
}

function afficherTableauImages ( $TableauImages, $NbImagesParPage = 15, $NbImagesParLigne = 3, $TableauIdClass = [], $Page = 1) 
{
    $MaxImg = count ( $TableauImages );
    $Start = $NbImagesParPage * ( $Page - 1 );
    $End   = min ( [ $NbImagesParPage *   $Page - 1, $MaxImg - 1 ] );
    $Attributs = faireAttributs ( $TableauIdClass );
    $i = $Start;

    while ( $i <= $End )
    {
        echo "<span $Attributs>" . $TableauImages[$i] . '</span>';

	    ++$i;

        if ( ! ( $i % $NbImagesParLigne ) ) 
	    {
	        echo '<br>';
    	}
    }
}

	 
function afficherLiensGallery ( $NbPages, $TabAttributs = array (), $Page = 1 ) 
{ 
    $Addr = $_SERVER ['SCRIPT_NAME'] . '?contexte=' . $_GET['contexte'] . '&Page=';

    for ( $i = 1 ; $i <= $NbPages ; ++$i )
    {
        if ( $Page == $i ) echo $i;
	else echo faireA ( $Addr . $i, $i, $TabAttributs );
    }
}

function afficherGallery ( $Dossier, $NbLignes, $NbCols, $TabAttributs = [], $Page = 1 )
{
    $NbImagesParPage = $NbLignes * $NbCols;
    $TableauImages = faireTableauImages ( $Dossier );
    $NbTotal = count ( $TableauImages );
    $NbPages = ceil ( $NbTotal / $NbImagesParPage );

    afficherTableauImages ( $TableauImages, $NbImagesParPage, $NbCols, $TabAttributs, $Page );

    if ( $NbTotal > $NbImagesParPage ) afficherLiensGallery ( $NbPages, $TabAttributs, $Page );

}

function donnerValeur ($de, $dans, $defaut="")
{
	return (isset ($dans[$de]) ? $dans[$de] : $defaut);
}