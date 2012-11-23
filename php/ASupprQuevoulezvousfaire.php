<?php 
	/* Inclure la session */
	include_once('session.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF8">
	<title>LPDW Gestion des absences - Que voulez-vous faire ?</title>
</head>

<body>

	<header>
		<h1>LPDW Gestion des absences</h1>
		<div>
		<?php
			include_once('connexion.inc.php');
			
			/* Ecrire un message de bienvenue personnalisé */
			print("<p>Bienvenue $prenom !</p>");
			
		?>
		</div>
		<div>
			<p><a href="index.html">Connexion</a> > Que voulez-vous faire ?</p>
		</div>
		<div>
		<p><a href='deconnexion.php'>Déconnexion</a></p>
		</div>
	</header>
	
	<section>
		<h1>Que voulez-vous faire ?</h1>
		<div>
			<a href="administration.html">Administration</a>
		</div>
		<div>
			<a href="quelgroupe.html">Gestion des absences</a>
		</div>
	</section>
	
</body>
</html>