<?php
	include_once('header.inc.php');
	
	$dbh = connectBDD::getDBO();
	//Récupération de l'id dans l'url
	$idUser = $_GET["id"];

	/* ------------- Gestion affichage des coordonnée de l'utilisateur et de la photo ------------- */

	//Création de la requête pour récupérer les informations sur l'utilisateur en fonction de l'id récupéré.
	$sql = "SELECT * FROM utilisateurs WHERE id_utilisateur=$idUser";
	//Exécution
	$resultat = $dbh->query($sql);

	//Affichage des coordonnées de l'utilisateur
	while($row=$resultat->fetch())
	{
	?>
		<section id="wrap">

			<h1>Profil d'un utilisateur</h1>

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
			</table>

			<table class="four columns">
				<thead>
					<tr>
						<th colspan="2">Compte</th>
					</tr>
				</thead>
				<tr>
					<td>Identifiant</td>
					<td><?php echo $row['identifiant']; ?></td>
				</tr>
				<tr>
					<td>Mot de passe</td>
					<td><?php echo $row['mot_de_passe']; ?></td>
				</tr>
				<tr>
					<td>Statut</td>
					<td>
						<?php
							//Gérer l'affichage du statut.
							$sqlStatut = "SELECT nom
											FROM statuts
											WHERE id_statut=
											(
												SELECT id_statut
												FROM utilisateurs
												WHERE id_utilisateur=$idUser
											)
							";
							$resultatStatut = $dbh->query($sqlStatut);
							foreach( $resultatStatut as $statut){
								echo $statut['nom'];
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Matières</td>
					<td>
						<?php
							//Création de la requête pour récupérer les groupes lié à l'utilisateur
							$sqlMatiere = "SELECT matieres.nom
									FROM matieres, utilisateurs_has_matieres
									WHERE matieres.id_matiere = utilisateurs_has_matieres.id_matiere
									AND utilisateurs_has_matieres.id_utilisateur=$idUser

							";

							//Exécution
							$resultatMatiere = $dbh->query($sqlMatiere);

							//Affichage des donnée récupéré
							foreach($resultatMatiere as $matiere){
							?>
								<p><?php echo $matiere['nom']; ?></p>
							<?php
							}
						?>
					</td>
				</tr>
			</table>
			
			<?php
				}
			?>

			<form  method="POST" class="custom" enctype="multipart/form-data" action="scriptPhp/supprimerUser.php" onsubmit="return confirm('Vous êtes sur le point de supprimer l\'utilisateur. \n Êtes vous sûr ?')">
				<input name="idUser" type="HIDDEN" value="<?php echo $idUser ?>">
				<input name="supprimer" type="submit" value="Supprimer" class="radius button alert">
			</form>

		</section>

		<div class="clear"></div>

<?php
	include_once('footer.inc.php');
?>