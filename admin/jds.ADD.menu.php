<?php
    include ('caisseaouts.php');
    include ('jds.CRUD.php');

?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="../js/typeahead.min.js"></script>

<li class="nav-item"><a class="nav-link cool-link" href="?contexte=jds">Jds</a></li>
<li class="nav-item"><a class="nav-link cool-link" href="?contexte=auteur">Auteur</a></li>
<li class="nav-item"><a class="nav-link cool-link" href="?contexte=illustrateur">Illustrateur</a></li>
<li class="nav-item"><a class="nav-link cool-link" href="?contexte=mecanique">Mécanique</a></li>
<li class="nav-item"><a class="nav-link cool-link" href="?contexte=editeur">Editeur</a></li>
<li class="nav-item"><a class="nav-link cool-link" href="?contexte=categorie">Categorie</a></li>
<li class="nav-item"><a class="nav-link cool-link" href="?contexte=niveau_de_jeu">Niveau de jeu</a></li>
<li class="nav-item"><a class="nav-link cool-link" href="?contexte=interaction">Interaction</a></li>

<div id="header" class="col-12 sticky-top">

<?php
switch (@$_GET ["contexte"])
{
    case "jds":
        include("jds.ADD.jds.php");
        break;
    case "auteur":
        include("jds.ADD.auteur.php");
        break;
    case "illustrateur":
        include("jds.ADD.illustrateur.php");
        break;
    case "mecanique":
        include("jds.ADD.mecanique.php");
        break;
    case "editeur":
        include("jds.ADD.editeur.php");
        break;
    case "categorie":
        include("jds.ADD.categorie.php");
        break;
    case "niveau_de_jeu":
        include("jds.ADD.niveau_de_jeu.php");
        break;
    case "interaction":
        include("jds.ADD.interaction.php");
        break;
    // default:
    //     include ("bienvenue.php");
    //     break;
}
?>


</div>
