<?php 
	/* Inclure la session */
	include_once('session.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF8">
	<title>LPDW Gestion des absences - Administration</title>
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
			<p><a href="index.html">Connexion</a> > <a href="quevoulezvousfaire.php">Que voulez-vous faire ?</a> > Administration ?</p>
		</div>
		<div>
		<p><a href='deconnexion.php'>Déconnexion</a></p>
		</div>
	</header>
	
	<section>
		<h1>Administration</h1>
		<section>
			<h1>Gestion des étudiants</h1>
			<p><a href="trombiAdminEtu.php">Voir les étudiants</a></p>
			<p><a href="formulaireEtu.php">Ajout d'un étudiant</a></p>
		</section>
		<section>
			<h1>Gestion des utilisateurs</h1>
			<p><a href="trombiAdminUser.php">Voir les utilisateurs</a></p>
			<p><a href="formulaireUser.php">Ajout d'un utilisateur</a></p>
		</section>
		<p><a href="nouvelle_promotion.html">Une nouvelle promotion est arrivée ? Vous pouvez partir sur de nouvelles bases en cliquant ici.</a></p>
	</section>
	
</body>
</html>