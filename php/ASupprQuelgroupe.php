<?php 
	/* Inclure la session */
	include_once('session.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF8">
	<title>LPDW Gestion des absences - Quel groupe</title>
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
			<p><a href="index.html">Connexion</a> > <a href="quevoulezvousfaire.php">Que voulez-vous faire ?</a> > Quel groupe ?</p>
		</div>
		<div>
		<p><a href='deconnexion.php'>Déconnexion</a></p>
		</div>
	</header>
	
	<section>
		<h1>Quel groupe est devant vous ?</h1>
		<p><a href="gestionAbsence.php">Promo entière</a></p>
		<p><a href="gestionAbsence.php">Gestion de projet</a> <a href="gestionAbsence.php">Mobile</a> <a href="gestionAbsence.php">Objets connectés</a></p>
	</section>
	
</body>
</html>