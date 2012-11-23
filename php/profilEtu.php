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
			<p>Adresse : <?php echo $row['adresse']; ?></p>
			<p>Code postal : <?php echo $row['code_postal']; ?></p>
			<p>Commune : <?php echo $row['commune']; ?></p>
			<p>
				Groupe :
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
			</p>
		</div>
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
		<div class="borderBloc">
			<p class="placementTitreBloc">Entreprise</p>
			<p>Nom : <?php echo $row['nom']; ?></p>
			<p>Tuteur : <?php echo $row['tuteur']; ?></p>
			<p>E-mail : <?php echo $row['email']; ?></p>
			<p>Téléphone : <?php echo $row['telephone']; ?></p>
			<p>Portable : <?php echo $row['portable']; ?></p>
			<p>Adresse : <?php echo $row['adresse']; ?></p>
			<p>Code postal : <?php echo $row['code_postal']; ?></p>
			<p>Commune : <?php echo $row['commune']; ?></p>
		</div>
		<?php
	}
	?>
	
	<form  method="POST" enctype="multipart/form-data" action="supprimerEtu.php" onsubmit="return confirm('Vous êtes sur le point de supprimer l\'étudiant. \n Êtes vous sûr ?')">
		<input type="HIDDEN" value="<?php echo $idEtu; ?>" name="idEtu" >
		<input type="submit" value="Supprimer" name="supprimer" >
	</form>
</body>
</html>

<?php 
	include_once('close.inc.php');
?>