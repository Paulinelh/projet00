<?php
	include_once('header.inc.php');
?>
<form  method="POST" class="custom" enctype="multipart/form-data" action="scriptPhp/upUser.php">

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
	</fieldset>

	<fieldset>
		<legend>Autres</legend>
		<div class="row">
			<div class="two mobile-one columns">
				<label class="right inline">Identifiant :</label>
			</div>
			<div class="ten mobile-three columns">
				<input name="identifiant" class="eight" type="text" />
			</div>
		</div>
		<div class="row">
			<div class="two mobile-one columns">
				<label class="right inline">Mot de passe :</label>
			</div>
			<div class="ten mobile-three columns">
				<input name="motDePasse" class="eight" type="text" onFocus="this.type='password'"/>
			</div>
		</div>
		<div class="row">
			<div class="two mobile-one columns">
				<label class="right inline">Statut :</label>
			</div>
			<div class="ten mobile-three columns">
				<select name="statut" class="eight" id="customDropdown">
					<?php 
					$dbh = connectBDD::getDBO();
					//Création de la requête pour récupérer les statuts disponible
					$sql = "SELECT * FROM statuts";
					//Exécution
					$resultat = $dbh->query($sql);

					//Affichage des coordonnées de l'étudiant
					while($row=$resultat->fetch()){
						?>
						<option value="<?php echo $row['id_statut'];?>" ><?php echo $row['nom'];?></option>
						<?php
					}
					?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="two mobile-one columns">
				<label class="right inline">Matière :</label>
			</div>
			<div class="ten mobile-three columns">
				<input type="text" class="eight" name="matiere0" />
				<div id="messageErreurMatiere"> 
					<p>On ne peut ajouter que 15 matières maximum</p>
				</div> 
				<input type="button" value="+" onclick="fAddText()" id="boutonAdd"/> 
			</div>
		</div>
		<div class="row">
			<div class="two mobile-one columns" id="labelmatiere">
			</div>
			<div class="ten mobile-three columns" id="cible">
			</div>
		</div>
	</fieldset>
	<input type="submit" value="Envoyer">
</form>
<script src="../javascripts/formulaireUser.js"></script>
<?php 
	include_once('close.inc.php');
?>