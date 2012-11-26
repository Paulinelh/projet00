<?php
	include_once('session.inc.php');
	include_once('Class/connectBDD.class.php');
?>


<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title>LP-DW - Gestion des absences</title>
  
  <!-- Included CSS Files (Uncompressed) -->
  <!--
  <link rel="stylesheet" href="stylesheets/foundation.css">
  -->
  
  <!-- Included CSS Files (Compressed) -->
  <link rel="stylesheet" href="../stylesheets/foundation.min.css">
  <link rel="stylesheet" href="../stylesheets/app.css">
  <link rel="stylesheet" href="../stylesheets/ecran.css">

  <script src="../javascripts/modernizr.foundation.js"></script>

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

</head>
<body>

<header>
	<!-- Basic Needs -->
	<nav class="top-bar">
		<ul>
			<li class="name">
				<h1><a href="gestion-absences.php"><img src="../images/logo.png" alt="LP-DW"></a></h1>
			</li>
			<li class="toggle-topbar"><a href="#"></a></li>
		</ul>
		
		<section>
			<?php
				if(isset($_SESSION['statut'])) {
					if(	$_SESSION['statut'] == 'Secretaire' || $_SESSION['statut'] == 'Responsable'){
			?>
				<ul class="nav-bar">
					<li><a href="gestion-absences.php">Gestion des absences</a></li>
					<li class="has-flyout">
						<a href="#">Etudiants</a>
						<a href="#" class="flyout-toggle"><span> </span></a>
						<ul class="flyout">
							<li><a href="gestion-etudiants.php">Gestion des étudiants</a></li>
							<li><a href="ajouter-etudiant.php">Ajouter un étudiant</a></li>
						</ul>
					</li>
					<li class="has-flyout">
						<a href="#">Utilisateurs</a>
						<a href="#" class="flyout-toggle"><span> </span></a>
						<ul class="flyout">
							<li><a href="gestion-utilisateurs.php">Gestion des utilisateurs</a></li>
							<li><a href="ajouter-utilisateur.php">Ajouter un utilisateur</a></li>
						</ul>
					</li>
					<li><a href="gestion-groupes.php">Groupes</a></li>
				</ul>
			<?php
					}
				}
			?>
			<ul class="right">
				<li><a href="deconnexion.php">Déconnexion</a></li>
			</ul>
		</section>
	</nav>
</header>