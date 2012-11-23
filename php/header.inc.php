<?php
	include_once('session.inc.php');
	include_once("class/connectBDD.class.php");
?>
<!DOCTYPE html>

<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" media="screen" href="../css/style.css">
	<link rel="stylesheet" media="screen" href="../css/app.css">
	<link rel="stylesheet" media="screen" href="../css/foundation.css">
	<link rel="stylesheet" media="screen" href="../css/foundation.min.css">
	<script src="../javascripts/jquery.js"></script>
</head>
<body>
<header>
	<h1><img src="../images/logo.png" alt="Logo"></h1>
	<nav>
		<?php
		if(isset($_SESSION['statut'])) {
			if(	$_SESSION['statut'] == 'Secretaire' || $_SESSION['statut'] == 'Responsable'){
		?>
			<ul>
				<li><a href="gestionAbsence.php">Gestion des absences</a></li>
				<li><a href="trombiAdminUser.php">Utilisateurs</a></li>
				<li><a href="trombiAdminEtu.php">Etudiants</a></li>
				<li><a href="groupe.php">Groupes</a></li>
			</ul>
			<div><a href="deconnexion.php"></a></div>
		<?php
			}
		}
		?>
	</nav>
	<a href="deconnexion.php">Se deconnecter</a>
</header>


