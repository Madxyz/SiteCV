<?php

switch (@$_GET ["contexte"])
{
    case "formation":
        include("formation&xp.php");
        break;
    case "competence":
        include("competence&pj.php");
        break;
    case "loisir":
        include("loisir.php");
        break;
    case "jds":
        include("jds/jds.ADD.menu.php");
        break;
    default:
        include ("bienvenue.php");
        break;
}