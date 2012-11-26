<?php
	include_once('header.inc.php');
?>

	<section id="wrap">

		<h1>Plan du site</h1>

		<ul>
			<li><a href="index.php">Connexion</a>
				<ul>
					<li><a href="gestion-absences.php">Gestion des absences</a></li>
					<li><a href="gestion-etudiants.php">Gestion des étudiants</a>
						<ul>
							<li><a href="ajouter-etudiant.php">Ajouter un étudiant</a></li>
							<li><a href="modifier-etudiant.php">Modifier un étudiant</a></li>
						</ul>
					</li>
					<li><a href="gestion-utilisateurs.php">Gestion des utilisateurs</a></li>
						<ul>
							<li><a href="ajouter-utilisateur.php">Ajouter un utilisateur</a></li>
							<li><a href="modifier-utilisateur.php">Modifier un utilisateur</a></li>
						</ul>
					</li>
					<li><a href="gestion-groupes.php">Gestion des groupes</a></li>
				</ul>
			</li>
		</ul>

	</section>

<?php
	include_once('footer.inc.php');
?>