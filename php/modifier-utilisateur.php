<?php
	include_once('header.inc.php');
?>

	<section id="ajoutEtudiant">
		<form>
			<fieldset class="fieldPhoto four columns">
				<legend>Photographie</legend>
				<div>
					<img src="avatar.jpg" alt="aperçu">
				</div>
				<div>
					<label for="photoUtil">Photographie</label>
					<input id="photoUtil" name="photoUtil" type="file">
				</div>
			</fieldset>
			
			<fieldset class="fieldCoor four columns">
				<legend>Coordonnées</legend>
				<div>
					<label for="nomUtil">Nom</label>
					<input id="nomUtil" name="nomUtil" type="text" placeholder="Nom" value="<?php echo('Roux') ?>">
				</div>
				<div>
					<label for="prenomUtil">Prénom</label>
					<input id="prenomUtil" name="prenomUtil" type="text" placeholder="Prénom" value="<?php echo('Emmanuelle') ?>">
				</div>
				<div>
					<label for="telUtil">Téléphone</label>
					<input id="telUtil" name="telUtil" type="tel" placeholder="Téléphone" value="<?php echo('') ?>">
				</div>
				<div>
					<label for="mobileUtil">Mobile</label>
					<input id="mobileUtil" name="mobileUtil" type="tel" placeholder="Mobile" value="<?php echo('') ?>">
				</div>
				<div>
					<label for="emailUtil">E-mail</label>
					<input id="emailUtil" name="emailUtil" type="email" placeholder="E-mail" value="<?php echo('') ?>">
				</div>
								
			</fieldset>
			
			<fieldset class="fieldCompte four columns">
				<legend>Compte</legend>
				<div>
					<label for="idUtil">Identifiant</label>
					<input id="idUtil" name="idUtil" type="text" placeholder="Identifiant" value="<?php echo('eroux') ?>">
				</div>
				<div>
					<label for="mdpUtil">Mot de passe</label>
					<input id="mdpUtil" name="mdpUtil" type="text" placeholder="Mot de passe" value="<?php echo('eroux') ?>">
				</div>
				<div>
					<label for="statUtil">Statut</label>
					<select id="statUtil" name="statUtil">
						<option>Intervenant</option>
						<option selected>Responsable pédagogique</option>
						<option>Secrétaire pédagogique</option>
					</select>
				</div>
				<div>
					<label for="matUtil1">Matière 1</label>
					<input id="matUtil1" name="matUtil1" type="text" placeholder="Matière 1" value="<?php echo("Histoire de l'Internet") ?>">
					<input type="button" value="+">
				</div>
				<div>
					<label for="matUtil2">Matière 2</label>
					<input id="matUtil2" name="matUtil2" type="text" placeholder="Matière 2" value="<?php echo("Référencement & ergonomie") ?>">
					<input type="button" value="+">
				</div>
				<div>
					<label for="matUtil3">Matière 3</label>
					<input id="matUtil3" name="matUtil3" type="text" placeholder="Matière 3" value="<?php echo('') ?>">
					<input type="button" value="+">
				</div>
				<div>
					<label for="matUtil4">Matière 4</label>
					<input id="matUtil4" name="matUtil4" type="text" placeholder="Matière 4" value="<?php echo('') ?>">
					<input type="button" value="+">
				</div>
				<div>
					<label for="matUtil5">Matière 5</label>
					<input id="matUtil5" name="matUtil5" type="text" placeholder="Matière 5" value="<?php echo('') ?>">
					<input type="button" value="+">
				</div>
			</fieldset>

			<div class="clear"></div>
			
			<ul class="button-group radius four columns">
				<li><a name="btUtiValidModif" class="radius button success">Valider</a></li>
				<li><a name="btUtiSuppr" class="radius button alert">Supprimer</a></li>
			</ul>	
		</form>
	</section>

	<div class="clear"></div>

<?php
	include_once('footer.inc.php');
?>