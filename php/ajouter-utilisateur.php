<?php
	include_once('header.inc.php');
?>

	<section id="wrap">

		<h1>Ajout d'un utilisateur</h1>
		
		<form method="POST" class="custom" enctype="multipart/form-data" action="scriptPhp/upUser.php">
			
			<div class="four columns">
				<img src="../images/futurPhotoEtu.png" alt="Aperçu photo de l'utilisateur">
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
					<label for="telephone">Téléphone</label>
					<input id="telephone" name="telephone" type="tel" placeholder="Téléphone" class="four columns">
				</div>
				<div>
					<label for="portable">Mobile</label>
					<input id="portable" name="portable" type="tel" placeholder="Mobile" class="four columns">
				</div>
				<div>
					<label for="email">E-mail</label>
					<input id="email" name="email" type="email" placeholder="E-mail" class="four columns">
				</div>			
			</fieldset>
			
			<fieldset class="myField four columns">
				<legend>Compte</legend>
				<div>
					<label for="identifiant">Identifiant</label>
					<input id="identifiant" name="identifiant" type="text" placeholder="Identifiant" class="four columns">
				</div>
				<div>
					<label for="motDePasse">Mot de passe</label>
					<input id="motDePasse" name="motDePasse" type="text" placeholder="Mot de passe" class="four columns">
				</div>
				<div>
					<label for="statut">Statut</label>
					<select name="statut" class="eight" id="customDropdown">
						<?php 
						$dbh = connectBDD::getDBO();
						//Création de la requête pour récupérer les statuts disponibles
						$sql = "SELECT * FROM statuts";
						//Exécution
						$resultat = $dbh->query($sql);

						//Affichage des statuts possibles de l'utilisateur
						while($row=$resultat->fetch()){
							?>
							<option value="<?php echo $row['id_statut'];?>" ><?php echo $row['nom'];?></option>
							<?php
						}
						?>
					</select>
				</div>

				<div>
					<label class="right inline">Matière</label>
					<input name="matiere0" type="text">
						<div id="messageErreurMatiere"> 
							<p>On ne peut ajouter que 15 matières maximum</p>
						</div> 
						<input id="boutonAdd" type="button" value="+" onclick="alert('Cette fonctionnalité sera prochainement mise en service');fAddText();"> 
					</div>
				</div>
			</fieldset>
			
			<div class="clear"></div>
			
			<div>
				<input name="btAjoutEtu" type="submit" value="Ajouter" class="radius button success">
			</div>
			
			<div class="clear"></div>
			
		</form>

	</section>
	
	<div class="clear"></div>

	<script src="../javascripts/formulaireUser.js"></script>

<?php
	include_once('footer.inc.php');
?>