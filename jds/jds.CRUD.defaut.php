<?php

// (nom, description, nombre_joueurs, duree_partie, note, avis, date_sortie, image)
//  (nom varchar(45),	description tinytext,	nombre_joueurs_min  tinyint(2),	nombre_joueurs_max  tinyint(2),	duree_partie tinyint(3),	note  decimal(2,2),
//       avis  tinytext,	date_sortie  date,	age tinyint(3),	langue  varchar(45),	image	varchar(45))

function listerjds ($jdsID)
{
	$maConnexion = DB::connexion ();

	$SQL = "SELECT id_jds, nom, description, nombre_joueurs_min, nombre_joueurs_max, duree_partie, note, avis, date_sortie, age, langue
	 FROM Jds WHERE id_jds = ?";

	$stmt = $maConnexion->prepare($SQL);
	$stmt->bind_param('i', $jdsID);

	$ok = $stmt->execute ();
	$result = $stmt->get_result();

	return $result->fetch_assoc();
}

function listerjdss ()
{
	$maConnexion = DB::connexion ();

	$SQL = "SELECT id_jds, nom, description, nombre_joueurs_min, nombre_joueurs_max, duree_partie, note, avis, date_sortie, age, langue
	FROM Jds" ;

	$result = $maConnexion->query($SQL);
	$rows = array();

	while($row = $result->fetch_assoc())
	{
		$rows[] = $row;
	}
	return $rows;
}

// auteur ******************************************************************************************
function listerAuteur ($jdsID)
{
	$maConnexion = DB::connexion ();

	$SQL = "SELECT id_auteur, prenom_auteur, nom_auteur
	 FROM auteur WHERE id_auteur = ?";

	$stmt = $maConnexion->prepare($SQL);
	$stmt->bind_param('i', $jdsID);

	$ok = $stmt->execute ();
	$result = $stmt->get_result();

	return $result->fetch_assoc();
}

function listerAuteurs ()
{
	$myDB = DB::connexion ();

	$SQL = "SELECT id_auteur, prenom_auteur, nom_auteur
	FROM auteur" ;

	$result = $myDB->query($SQL);
	$rows = array();

	while($row = $result->fetch_assoc())
	{
		$rows[] = $row;
	}
	return $rows;
}

// illustrateur ******************************************************************************************
function listerIllustrateur ($jdsID)
{
	$maConnexion = DB::connexion ();

	$SQL = "SELECT id_illustrateur, prenom_illustrateur, nom_illustrateur
	 FROM illustrateur WHERE id_illustrateur = ?";

	$stmt = $maConnexion->prepare($SQL);
	$stmt->bind_param('i', $jdsID);

	$ok = $stmt->execute ();
	$result = $stmt->get_result();

	return $result->fetch_assoc();
}


function listerIllustrateurs ()
{
	$myDB = DB::connexion ();

	$SQL = "SELECT id_illustrateur, prenom_illustrateur, nom_illustrateur
	FROM illustrateur" ;

	$result = $myDB->query($SQL);
	$rows = array();

	while($row = $result->fetch_assoc())
	{
		$rows[] = $row;
	}
	return $rows;
}


// mécanique ******************************************************************************************
function listerMecanique ($jdsID)
{
	$maConnexion = DB::connexion ();

	$SQL = "SELECT id_mecanique, nom_mecanique
	 FROM mecanique WHERE id_mecanique = ?";

	$stmt = $maConnexion->prepare($SQL);
	$stmt->bind_param('i', $jdsID);

	$ok = $stmt->execute ();
	$result = $stmt->get_result();

	return $result->fetch_assoc();
}

function listerMecaniques ()
{
	$myDB = DB::connexion ();

	$SQL = "SELECT id_mecanique, nom_mecanique
	FROM mecanique" ;

	$result = $myDB->query($SQL);
	$rows = array();

	while($row = $result->fetch_assoc())
	{
		$rows[] = $row;
	}
	return $rows;
}

// editeur ******************************************************************************************
function listerEditeur ($jdsID)
{
	$maConnexion = DB::connexion ();

	$SQL = "SELECT id_editeur, nom_editeur
	 FROM editeur WHERE id_editeur = ?";

	$stmt = $maConnexion->prepare($SQL);
	$stmt->bind_param('i', $jdsID);

	$ok = $stmt->execute ();
	$result = $stmt->get_result();

	return $result->fetch_assoc();
}

function listerEditeurs ()
{
	$myDB = DB::connexion ();

	$SQL = "SELECT id_editeur, nom_editeur
	FROM editeur" ;

	$result = $myDB->query($SQL);
	$rows = array();

	while($row = $result->fetch_assoc())
	{
		$rows[] = $row;
	}
	return $rows;
}

// categorie ******************************************************************************************
function listerCategorie ($jdsID)
{
	$maConnexion = DB::connexion ();

	$SQL = "SELECT id_categorie, nom_categorie
	 FROM categorie WHERE id_categorie = ?";

	$stmt = $maConnexion->prepare($SQL);
	$stmt->bind_param('i', $jdsID);

	$ok = $stmt->execute ();
	$result = $stmt->get_result();

	return $result->fetch_assoc();
}

function listerCategories ()
{
	$myDB = DB::connexion ();

	$SQL = "SELECT id_categorie, nom_categorie
	FROM categorie" ;

	$result = $myDB->query($SQL);
	$rows = array();

	while($row = $result->fetch_assoc())
	{
		$rows[] = $row;
	}
	return $rows;
}

// niveau_de_jeu ******************************************************************************************
function listerNvDeJeu ($jdsID)
{
	$maConnexion = DB::connexion ();

	$SQL = "SELECT id_nv_de_jeu, valeur_nv_de_jeu
	 FROM niveau_de_jeu WHERE id_nv_de_jeu = ?";

	$stmt = $maConnexion->prepare($SQL);
	$stmt->bind_param('i', $jdsID);

	$ok = $stmt->execute ();
	$result = $stmt->get_result();

	return $result->fetch_assoc();
}


function listerNvDeJeux ()
{
	$myDB = DB::connexion ();

	$SQL = "SELECT id_nv_de_jeu, valeur_nv_de_jeu
	FROM niveau_de_jeu" ;

	$result = $myDB->query($SQL);
	$rows = array();

	while($row = $result->fetch_assoc())
	{
		$rows[] = $row;
	}
	return $rows;
}

// interaction ******************************************************************************************
function listerInteraction ($jdsID)
{
	$maConnexion = DB::connexion ();

	$SQL = "SELECT id_interaction, nom_interaction
	 FROM interaction WHERE id_interaction = ?";

	$stmt = $maConnexion->prepare($SQL);
	$stmt->bind_param('i', $jdsID);

	$ok = $stmt->execute ();
	$result = $stmt->get_result();

	return $result->fetch_assoc();
}


function listerInteractions ()
{
	$myDB = DB::connexion ();

	$SQL = "SELECT id_interaction, nom_interaction
	FROM interaction" ;

	$result = $myDB->query($SQL);
	$rows = array();

	while($row = $result->fetch_assoc())
	{
		$rows[] = $row;
	}
	return $rows;
}