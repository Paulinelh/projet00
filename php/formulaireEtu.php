<?php
	include_once('header.inc.php');
?>
	<form  method="POST" class="custom" enctype="multipart/form-data" action="scriptPhp/upEtu.php">
	
		<div class="row">
			<img src="../images/futurPhotoEtu.png" width="290" height="230"/>
			<div class="ten mobile-three columns">
				<input type="file" class="eight" name="photo" size="40"/> 
			</div>
		</div>
		
		<fieldset>
			<legend>Coordonnée</legend>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Nom :</label>
				</div>
				<div class="ten mobile-three columns">
					<input type="text" class="eight" name="nom"/> 
				</div>
			</div>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Prénom :</label>
				</div>
				<div class="ten mobile-three columns">
					<input type="text" class="eight" name="prenom" /> 
				</div>
			</div>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Téléphone :</label>
				</div>
				<div class="ten mobile-three columns">
					<input type="text" class="eight" name="telephone" /> 
				</div>
			</div>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Portable :</label>
				</div>
				<div class="ten mobile-three columns">
					<input type="text" class="eight" name="portable"/> 
				</div>
			</div>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">E-mail :</label>
				</div>
				<div class="ten mobile-three columns">
					<input type="text" class="eight" name="email" /> 
				</div>
			</div>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Adresse :</label>
				</div>
				<div class="ten mobile-three columns">
					<input type="text" class="eight" name="adresse" /> 
				</div>
			</div>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Code postal :</label>
				</div>
				<div class="ten mobile-three columns">
					<input type="text" class="eight" name="codepostal"/> 
				</div>
			</div>
			
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Commune :</label>
				</div>
				<div class="ten mobile-three columns">
					<input type="text" class="eight" name="commune" /> 
				</div>
			</div>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Groupe :</label>
				</div>
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
		
		<fieldset>
			<legend>Entreprise</legend>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Nom :</label>
				</div>
				<div class="ten mobile-three columns">
					<input type="text" class="eight" name="nomEnt"/> 
				</div>
			</div>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Tuteur :</label>
				</div>
				<div class="ten mobile-three columns">
					<input type="text" class="eight" name="tuteur" /> 
				</div>
			</div>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Téléphone :</label>
				</div>
				<div class="ten mobile-three columns">
					<input type="text" class="eight" name="telephoneEnt" /> 
				</div>
			</div>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Portable :</label>
				</div>
				<div class="ten mobile-three columns">
					<input type="text" class="eight" name="portableEnt"/> 
				</div>
			</div>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">E-mail :</label>
				</div>
				<div class="ten mobile-three columns">
					<input type="text" class="eight" name="emailEnt" /> 
				</div>
			</div>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Adresse :</label>
				</div>
				<div class="ten mobile-three columns">
					<input type="text" class="eight" name="adresseEnt" /> 
				</div>
			</div>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Code postal :</label>
				</div>
				<div class="ten mobile-three columns">
					<input type="text" class="eight" name="codepostalEnt"/>
				</div>
			</div>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Commune :</label>
				</div>
				<div class="ten mobile-three columns">
					<input type="text" class="eight" name="communeEnt" /> 
				</div>
			</div>			
		</fieldset>
		<input type="submit" value="Envoyer">
	</form>
<?php 
	include_once('close.inc.php');
?>