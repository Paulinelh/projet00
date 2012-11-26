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
	while($row=$resultat->fetch())
	{
?>
	<section id="ajoutEtudiant">
		<form method="POST" class="custom" enctype="multipart/form-data" action="scriptPhp/modifierEtu.php">
			<fieldset class="fieldPhoto four columns">
				<legend>Photographie</legend>
				<div>
					<img src="avatar.jpg" alt="aperçu">
				</div>
				<div>
					<label for="photoEtu">Photographie</label>
					<input id="photoEtu" name="photoEtu" type="file">
				</div>
			</fieldset>
			
			<fieldset class="fieldCoor four columns">
				<legend>Coordonnées</legend>
				<div>
					<label for="nomEtu">Nom</label>
					<input id="nomEtu" name="nomEtu" type="text" placeholder="<?php echo $row['nom']; ?>" value="<?php echo $row['nom']; ?>">
				</div>
				<div>
					<label for="prenomEtu">Prénom</label>
					<input id="prenomEtu" name="prenomEtu" type="text" placeholder="<?php echo $row['prenom']; ?>" value="<?php echo $row['prenom']; ?>">
				</div>
				<div>
					<label for="telEtu">Téléphone</label>
					<input id="telEtu" name="telEtu" type="tel" placeholder="<?php echo $row['telephone']; ?>" value="<?php echo $row['telephone']; ?>">
				</div>
				<div>
					<label for="mobileEtu">Mobile</label>
					<input id="mobileEtu" name="mobileEtu" type="tel" placeholder="<?php echo $row['portable']; ?>" value=" <?php echo $row['portable']; ?>">
				</div>
				<div>
					<label for="emailEtu">E-mail</label>
					<input id="emailEtu" name="emailEtu" type="email" placeholder="<?php echo $row['email']; ?>" value="<?php echo $row['email']; ?>">
				</div>
				<div>
					<label for="adresseEtu">Adresse</label>
					<input id="adresseEtu" name="adresseEtu" type="text" placeholder="<?php echo $row['adresse']; ?>" value="<?php echo $row['adresse']; ?>">
				</div>
				<div>
					<label for="codepostEtu">Code postal</label>
					<input id="codepostEtu" name="codepostEtu" type="number" placeholder="<?php echo $row['code_postal']; ?>" value="<?php echo $row['code_postal']; ?>">
				</div>
				<div>
					<label for="communeEtu">Commune</label>
					<input id="communeEtu" name="communeEtu" type="text" placeholder="<?php echo $row['commune']; ?>" value="<?php echo $row['commune']; ?>">
				</div>
				<div>
					<label for="groupeEtu">Groupe</label>
					<?php
						$dbh = connectBDD::getDBO();
						$nbGroupesSql = "SELECT COUNT(*) FROM groupes";
						$nbGroupesfetch = $dbh->query($nbGroupesSql);
						$nbGroupes = $nbGroupesfetch->fetch();
						if($nbGroupes[0]>0){//if il y a des groupes
					?>
							<div class="ten mobile-three columns">
								<select name="groupe[]" id="customDropdown" class="eight"  multiple="multiple">
					<?php
							
								$nomGroupeSql = "SELECT * FROM groupes";
								$nomGroupe = $dbh->query($nomGroupeSql);
								while($row=$nomGroupe->fetch()){
					?>
									<option value="<?php echo $row['id_groupe']; ?>"><?php echo $row['nom']; ?></option>
					<?php
								}
					?>
								</select>
								<p>Maintenir appuyé le bouton Ctrl (windows) ou Commande (Mac) pour sélectionner plusieurs groupes.</p>
							</div>
					<?php
						}else{
							?>
							<p>Aucun groupe n'a encore été ajouté.</p>
							<?php
						}
					?>
				</div>			
			</fieldset>
			
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
			<fieldset class="fieldEnt four columns">
				<legend>Entreprise</legend>
				<div>
					<label for="nomEnt">Nom</label>
					<input id="nomEnt" name="nomEnt" type="text" placeholder=" <?php echo $row['nom']; ?>" value="<?php echo $row['nom']; ?>">
				</div>
				<div>
					<label for="nomTut">Tuteur</label>
					<input id="nomTut" name="nomTut" type="text" placeholder="<?php echo $row['tuteur']; ?>" value="<?php echo $row['tuteur']; ?>">
				</div>
				<div>
					<label for="telTut">Téléphone</label>
					<input id="telTut" name="telTut" type="tel" placeholder="<?php echo $row['telephone']; ?>" value="<?php echo $row['telephone']; ?>">
				</div>
				<div>
					<label for="mobileTut">Mobile</label>
					<input id="mobileTut" name="mobileTut" type="tel" placeholder="<?php echo $row['portable']; ?>" value="<?php echo $row['portable']; ?>">
				</div>
				<div>
					<label for="emailTut">E-mail</label>
					<input id="emailTut" name="emailTut" type="email" placeholder="<?php echo $row['email']; ?>" value="<?php echo $row['email']; ?>">
				</div>
				<div>
					<label for="adresseEnt">Adresse</label>
					<input id="adresseEnt" name="adresseEnt" type="text" placeholder="<?php echo $row['adresse']; ?>" value="<?php echo $row['adresse']; ?>">
				</div>
				<div>
					<label for="codepostEnt">Code postal</label>
					<input id="codepostEnt" name="codepostEnt" type="number" placeholder=" <?php echo $row['code_postal']; ?>" value=" <?php echo $row['code_postal']; ?>">
				</div>
				<div>
					<label for="communeEnt">Commune</label>
					<input id="communeEnt" name="communeEnt" type="text" placeholder="<?php echo $row['commune']; ?>" value="<?php echo $row['commune']; ?>">
				</div>
			</fieldset>

			<div class="clear"></div>
			<input id="btValidAjoutEtu" name="btValidAjoutEtu" type="submit" value="Valider" class="radius button success">
			
			<!--<ul class="button-group radius four columns">
				<li><a name="btEtuValidModif" class="radius button success">Valider</a></li>
				<li><a name="btEtuSuppr" class="radius button alert">Supprimer</a></li>
			</ul>
			-->
		</form>
	</section>
<?php
	}
?>
	<div class="clear"></div>

<?php
	include_once('footer.inc.php');
?>