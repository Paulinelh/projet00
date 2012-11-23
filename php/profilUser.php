<?php
	include_once('header.inc.php');

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
		<div>
			<img src="<?php echo $row['photo']; ?>" alt="Photo de <?php echo $row['nom']; ?> <?php echo $row['prenom']; ?>" width="290" height="230" />
		</div>
		<div class="borderBloc">
			<p class="placementTitreBloc">Coordonnée</p>
			<p>Nom : <?php echo $row['nom']; ?></p>
			<p>Prénom : <?php echo $row['prenom']; ?></p>
			<p>E-mail : <?php echo $row['email']; ?></p>
			<p>Téléphone : <?php echo $row['telephone']; ?></p>
			<p>Portable : <?php echo $row['portable']; ?></p>
		</div>
		<div class="borderBloc">
			<p class="placementTitreBloc">Autres</p>
			<p>Identifiant : <?php echo $row['identifiant']; ?></p>
			<p>Mot de passe : <?php echo $row['mot_de_passe']; ?></p>
			<p>Statut : 
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
			</p>
			<p>
				Matières :
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
			</p>
		</div>
	<?php
	}
	?>

	<form  method="POST" class="custom" enctype="multipart/form-data" action="scriptPhp/supprimerUser.php" onsubmit="return confirm('Vous êtes sur le point de supprimer l\'utilisateur. \n Êtes vous sûr ?')">
		<input type="HIDDEN" value="<?php echo $idUser ?>" name="idUser" >
		<input type="submit" value="Supprimer" name="supprimer" >
	</form>
<?php 
	include_once('close.inc.php');
?>