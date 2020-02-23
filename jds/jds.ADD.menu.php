<?php
    include ('caisseaouts.php');
    include ('jds.CRUD.defaut.php');
    // class="nav nav-pills nav-fill"
?>
<div class= container>

<ul id="header2" class="nav nav-pills nav-fill">
    <li class="nav-item"><a class="nav-link cool-link" href="?contexte=jds&bdd=jds">Liste jeux de société</a></li>
    <li class="nav-item"><a class="nav-link cool-link" href="?contexte=jds&bdd=auteur">Auteurs</a></li>
    <li class="nav-item"><a class="nav-link cool-link" href="?contexte=jds&bdd=illustrateur">Illustrateurs</a></li>
    <li class="nav-item"><a class="nav-link cool-link" href="?contexte=jds&bdd=mecanique">Mécaniques</a></li>
    <li class="nav-item"><a class="nav-link cool-link" href="?contexte=jds&bdd=editeur">Editeurs</a></li>
    <li class="nav-item"><a class="nav-link cool-link" href="?contexte=jds&bdd=categorie">Categories</a></li>
    <li class="nav-item"><a class="nav-link cool-link" href="?contexte=jds&bdd=niveau_de_jeu">Niveaux de jeu</a></li>
    <li class="nav-item"><a class="nav-link cool-link" href="?contexte=jds&bdd=interaction">Interaction</a></li>
</ul>

<?php
switch (@$_GET ["bdd"])
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
}
?>

</div>