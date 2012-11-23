<?php
	include_once('header.inc.php');
?>
<div>
	<p>Groupe précédemment ajouté :</p>
	<?php
		$nbGroupesSql = "SELECT COUNT(*) FROM groupes";
		$nbGroupesQuery = $dbh->query($nbGroupesSql);
		$nbGroupes = $nbGroupesQuery->fetch();


		if($nbGroupes[0]>0){//if il y a des groupes
			?>
			<form  method="POST" class="custom" enctype="multipart/form-data" action="scriptPhp/supprimerGroupe.php" onsubmit="return confirm('Vous êtes sur le point de supprimer des groupes. \n Êtes vous sûr ?')">
			<?php
				$dbh = connectBDD::getDBO();
				$nomGroupeSql = "SELECT * FROM groupes";
				$nomGroupe = $dbh->query($nomGroupeSql);
				while($row=$nomGroupe->fetch()){
					?>
						<p> 
							<input type="checkbox" name="groupe[]" value="<?php echo $row['id_groupe']; ?>"><?php echo $row['nom']; ?>
						</p>
					<?php
				}
			?>
				<input type="submit" value="Supprimer les groupes sélectionnés !" name="supprimer" >
			</form>
			<?php
		}else{
			?>
			<p>Aucun groupe n'a encore été ajouté.</p>
			<?php
		}
	?>
</div>
<form  method="POST" class="custom" enctype="multipart/form-data" action="scriptPhp/ajouterGroupe.php">
	<fieldset>
		<legend>Ajout d'un groupe</legend>
		<div class="row">
			<div class="two mobile-one columns">
				<label class="right inline">Nom du groupe :</label>
			</div>
			<div class="ten mobile-three columns">
				<input type="text" class="eight" name="nomGroupe"/>
			</div>
		</div>
		<input type="submit" value="Envoyer">
	</fieldset>
</form>
<?php 
	include_once('close.inc.php');
?>