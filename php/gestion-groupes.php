<?php
	include_once('header.inc.php');
?>

	<section id="wrap">

		<h1>Gestion des groupes</h1>

		<fieldset>
			<legend>Groupe(s) précédemment ajouté(s)</legend>
			<?php
				$dbh = connectBDD::getDBO();
				$nbGroupesSql = "SELECT COUNT(*) FROM groupes";
				$nbGroupesQuery = $dbh->query($nbGroupesSql);
				$nbGroupes = $nbGroupesQuery->fetch();


				if($nbGroupes[0]>0){//if il y a des groupes
					?>
					<form  method="POST" class="custom" enctype="multipart/form-data" action="scriptPhp/supprimerGroupe.php" onsubmit="return confirm('Vous êtes sur le point de supprimer des groupes. \n Êtes-vous sûr ?')">
					<?php
						$dbh = connectBDD::getDBO();
						$nomGroupeSql = "SELECT * FROM groupes";
						$nomGroupe = $dbh->query($nomGroupeSql);
						while($row=$nomGroupe->fetch()){
							?>
								<div> 
									<input name="groupe[]" type="checkbox" value="<?php echo $row['id_groupe']; ?>">
									<?php echo $row['nom']; ?>
								</div>
							<?php
						}
					?>
						<input name="supprimer" type="submit" value="Supprimer les groupes sélectionnés" class="radius button alert">
					</form>
					<?php
				}else{
					?>
					<p>Aucun groupe n'a encore été ajouté.</p>
					<?php
				}
			?>
		</fieldset>

		<form  method="POST" class="custom" enctype="multipart/form-data" action="scriptPhp/ajouterGroupe.php">
			<fieldset>
				<legend>Ajout d'un groupe</legend>
				<div>
					<label>Nom du groupe</label>
					<input name="nomGroupe" type="text">
				</div>
				<div>
					<input type="submit" value="Ajouter" class="radius button success">
				</div>
			</fieldset>
		</form>

		<div class="clear"></div>

	</section>

	<div class="clear"></div>

<?php
	include_once('footer.inc.php');
?>