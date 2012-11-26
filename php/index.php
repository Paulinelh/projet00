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

  <script src="javascripts/modernizr.foundation.js"></script>

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
				<h1><img src="../images/logo.png" alt="LP-DW"></h1>
			</li>
			<li class="toggle-topbar"><a href="#"></a></li>
		</ul>
	</nav>
</header>

<?php
	if (isset($_GET["error"])) {
		if($_GET["error"] == 0){
			echo 'Mot de passe ou Identifiant incorrect';
		}else if($_GET["error"] == 1){
			echo 'Veuillez remplir tous les champs';
		}else if($_GET["error"] == 2){
			echo 'Vous devez vous connectez pour accedez au site';
		}
	}
	if (isset($_GET["deconnexion"])) {
		echo 'Vous avez été déconnecté du site avec succès.';
	}
?>

<section id="wrap">
	<form action="scriptPhp/connexion.php" method="POST">
		<fieldset>
			<legend>Connexion</legend>
			<div>
				<label for="identifiant">Identifiant</label>
				<input id="identifiant" name="identifiant" type="text">
			</div>
			<div>
				<label for="motdepasse">Mot de passe</label>
				<input id="motdepasse" name="motdepasse" type="password">
			</div>
			<div>
				<input name="connexion" type="submit" value="Connexion">
			</div>
			<div>
				<a href="#" onclick="alert('Cette fonctionnalité sera prochainement mise en service.')">Mot de passe oublié ?</a>
			</div>
		</fieldset>
	</form>

	<div class="clear"></div>
	
</section>

<div class="clear"></div>

<?php
	include_once('footer.inc.php');
?>