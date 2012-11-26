<?php
	include_once('header.inc.php');
	$dbh = connectBDD::getDBO();
	
	//Récupération de l'id dans l'url
	$idEtu = $_GET["id"];
	
	/* ------------- Gestion affichage des coordonnée de l'étudiant et de la photo ------------- */
	
	//Création de la requête pour récupérer les informations sur l'étudiant en fonction de l'id récupéré.
	$sql = "SELECT * FROM etudiants WHERE id_etudiant=$idEtu";
	//Exécution
	$resultat = $dbh->query($sql);
	
	//Affichage des coordonnées de l'étudiant
	while($row=$resultat->fetch())
	{
		?>
		<section id="wrap">

			<h1>Profil d'un étudiant</h1>

			<div class="four columns">
				<img class="photo" src="<?php echo $row['photo']; ?>" alt="Photo de <?php echo $row['prenom']; ?> <?php echo $row['nom']; ?>">
			</div>

			<table class="four columns">
				<thead>
					<tr>
						<th colspan="2">Coordonnées</th>
					</tr>
				</thead>
				<tr>
					<td>Nom</td>
					<td><?php echo $row['nom']; ?></td>
				</tr>
				<tr>
					<td>Prénom</td>
					<td><?php echo $row['prenom']; ?></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td><?php echo $row['email']; ?></td>
				</tr>
				<tr>
					<td>Téléphone</td>
					<td><?php echo $row['telephone']; ?></td>
				</tr>
				<tr>
					<td>Portable</td>
					<td><?php echo $row['portable']; ?></td>
				</tr>
				<tr>
					<td>Adresse</td>
					<td><?php echo $row['adresse']; ?></td>
				</tr>
				<tr>
					<td>Code postal</td>
					<td><?php echo $row['code_postal']; ?></td>
				</tr>
				<tr>
					<td>Commune</td>
					<td><?php echo $row['commune']; ?></td>
				<tr>
					<td>Groupe</td>
					<td>
						<?php 
							//Création de la requête pour récupérer les groupes lié à l'étudiant
							$sqlGroupe = "SELECT groupes.nom
									FROM groupes, etudiants_has_groupes
									WHERE groupes.id_groupe = etudiants_has_groupes.id_groupe
									AND etudiants_has_groupes.id_etudiant=$idEtu
										
							";
							//Exécution
							$resultatGroupe = $dbh->query($sqlGroupe);
							//Affichage des donnée récupéré
							foreach($resultatGroupe as $test){
							?>
								<p><?php echo $test['nom']; ?></p>
							<?php
							}
						
						?>
					</td>
				</tr>
			</table>
		
			<div class="clear"></div>

			<?php
				}

				/* ------------- Gestion affichage de l'entreprise ------------- */
				//Création de la requête pour récupérer les informations de l'entreprise lié à l'étudiant.
				$sqlEnt = "SELECT * 
					FROM entreprises
					WHERE id_entreprise=
						(
							SELECT id_entreprise 
							FROM etudiants 
							WHERE id_etudiant=$idEtu
						)
					";
				$resultatEnt = $dbh->query($sqlEnt);
				
				//Affichage des information concernant l'entreprise de l'étudiant
				while($row=$resultatEnt->fetch())
				{
			?>
			<table class="four columns">
				<thead>
					<tr>
						<th colspan="2">Entreprise</th>
					</tr>
				</thead>
				<tr>
					<td>Nom</td>
					<td><?php echo $row['nom']; ?></td>
				</tr>
				<tr>
					<td>Tuteur</td>
					<td><?php echo $row['tuteur']; ?></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td><?php echo $row['email']; ?></td>
				</tr>
				<tr>
					<td>Téléphone</td>
					<td><?php echo $row['telephone']; ?></td>
				</tr>
				<tr>
					<td>Portable</td>
					<td><?php echo $row['portable']; ?></td>
				</tr>
				<tr>
					<td>Adresse</td>
					<td><?php echo $row['adresse']; ?></td>
				</tr>
				<tr>
					<td>Code postal</td>
					<td><?php echo $row['code_postal']; ?></td>
				</tr>
				<tr>
					<td>Commune</td>
					<td><?php echo $row['commune']; ?></td>
				</tr>
			</table>
			<?php
				}
			?>

		<form  method="POST" enctype="multipart/form-data" action="supprimerEtu.php" onsubmit="return confirm('Vous êtes sur le point de supprimer l\'étudiant. \n Êtes vous sûr ?')">
			<input name="idEtu" type="HIDDEN" value="<?php echo $idEtu; ?>">
			<input name="supprimer" type="submit" value="Supprimer" class="radius button alert">
		</form>

		<!--
		<section class="recherche">

			<h1>Recherche des absences :</h1>

			<form action="#" method="POST">

				<div>
					<label for="rechDateDeb">Date de début</label>
					<input id="rechDateDeb" name="rechDateDeb" type="text" placeholder="JJ/MM/AAAA">
				</div>

				<div>
					<label for="rechDateFin">Date de fin</label>
					<input id="rechDateFin" name="rechDateFin" type="text" placeholder="JJ/MM/AAAA">
				</div>

				<div>
					<input id="rechSubmit" name="rechSubmit" type="submit" value="Rechercher">
				</div>

			</form>

			<div>
				<input id="toutAbs" name="toutAbs" type="button" value="Toutes les absences">
			</div>

			<section>
				<h1>Ses absences : <?php echo 'nbAbsTotal'; ?></h1>
				<article>
					<h1>Absence(s) en cours de justification : <?php echo 'nbAbsEnCoursJus'; ?></h1>
					<ul>
						<li>
							Le <?php echo 'dateAbs'; ?> de <?php echo 'heureAbs'; ?>.
							<a href="#" class="validAbs small radius button success">Yes</a>
							<a href="#" class="noValidAbs small radius button alert">No</a>
						</li>
					</ul>
				</article>

				<article>
					<h1>Absence(s) justifiées : <?php echo 'nbAbsJus'; ?></h1>
					<ul>
						<li>Le <?php echo 'dateAbs'; ?> de <?php echo 'heureAbs'; ?>.</li>
						<li>Le <?php echo 'dateAbs'; ?> de <?php echo 'heureAbs'; ?>.</li>
					</ul>
				</article>

				<article>
					<h1>Absence(s) non justifiée(s) : <?php echo 'nbAbsEnCoursJus'; ?></h1>
					<ul>
						<li>Le <?php echo 'dateAbs'; ?> de <?php echo 'heureAbs'; ?>.</li>
					</ul>
				</article>

			</section>

		</section>
		-->

	</section>

	<div class="clear"></div>

<?php
	include_once('footer.inc.php');
?>