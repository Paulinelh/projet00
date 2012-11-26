<?php
	include_once('header.inc.php');
?>

	<section id="wrap">

		<h1>Ajout d'un étudiant</h1>
		
		<form method="POST" class="custom" enctype="multipart/form-data" action="scriptPhp/upEtu.php">
			
			<div class="four columns">
				<img src="../images/futurPhotoEtu.png" alt="Aperçu photo de l'étudiant">
				<div>
					<label for="photo">Photographie</label>
					<input id="photo" name="photo" type="file">
				</div>
			</div>
						
			<fieldset class="myField four columns">
				<legend>Coordonnées</legend>
				<div>
					<label for="nom">Nom</label>
					<input id="nom" name="nom" type="text" placeholder="Nom" class="four columns">
				</div>
				<div>
					<label for="prenom">Prénom</label>
					<input id="prenom" name="prenom" type="text" placeholder="Prénom" class="four columns">
				</div>
				<div>
					<label for="telephone">Téléphone fixe</label>
					<input id="telephone" name="telephone" type="tel" placeholder="Téléphone" class="four columns">
				</div>
				<div>
					<label for="portable">Téléphone obile</label>
					<input id="portable" name="portable" type="tel" placeholder="Mobile" class="four columns">
				</div>
				<div>
					<label for="email">E-mail</label>
					<input id="email" name="email" type="email" placeholder="E-mail" class="four columns">
				</div>
				<div>
					<label for="adresse">Adresse</label>
					<input id="adresse" name="adresse" type="text" placeholder="Adresse" class="four columns">
				</div>
				<div>
					<label for="codepostal">Code postal</label>
					<input id="codepostal" name="codepostal" type="number" placeholder="Code postal" class="four columns">
				</div>
				<div>
					<label for="commune">Commune</label>
					<input id="commune" name="commune" type="text" placeholder="Commune" class="four columns">
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
								<p>Maintenir appuyé le bouton Ctrl (Windows) ou Commande (Mac) pour sélectionner plusieurs groupes.</p>
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
			
			<fieldset class="myField four columns">
				<legend>Entreprise</legend>
				<div>
					<label for="nomEnt">Nom</label>
					<input id="nomEnt" name="nomEnt" type="text" placeholder="Nom de l'entreprise" class="four columns">
				</div>
				<div>
					<label for="tuteur">Tuteur</label>
					<input id="tuteur" name="tuteur" type="text" placeholder="Nom du tuteur" class="four columns">
				</div>
				<div>
					<label for="telephoneEnt">Téléphone</label>
					<input id="telephoneEnt" name="telephoneEnt" type="tel" placeholder="Téléphone" class="four columns">
				</div>
				<div>
					<label for="portableEnt">Mobile</label>
					<input id="portableEnt" name="portableEnt" type="tel" placeholder="Mobile" class="four columns">
				</div>
				<div>
					<label for="emailEnt">E-mail</label>
					<input id="emailEnt" name="emailEnt" type="email" placeholder="E-mail" class="four columns">
				</div>
				<div>
					<label for="adresseEnt">Adresse</label>
					<input id="adresseEnt" name="adresseEnt" type="text" placeholder="Adresse" class="four columns">
				</div>
				<div>
					<label for="codepostalEnt">Code postal</label>
					<input id="codepostalEnt" name="codepostalEnt" type="number" placeholder="Code postal" class="four columns">
				</div>
				<div>
					<label for="communeEnt">Commune</label>
					<input id="communeEnt" name="communeEnt" type="text" placeholder="Commune" class="four columns">
				</div>
			</fieldset>
			
			<div class="clear"></div>
			
			<div>
				<input name="btValidAjoutEtu" type="submit" value="Ajouter" class="radius button success">
			</div>
			
			<div class="clear"></div>

		</form>

	</section>
	
	<div class="clear"></div>

<?php
	include_once('footer.inc.php');
?>