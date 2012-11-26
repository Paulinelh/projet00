<?php
	include_once('header.inc.php');
?>

	<section id="wrap">

		<h1>Gestion des utilisateurs</h1>
	
		<!-- Aller à la page Ajouter un utilisateur -->
		<div class="btAjoutEtu">
			<a href="ajouter-utilisateur.php" class="radius button">Ajouter</a>
		</div>

		<div class="clear"></div>
		
		<?php
			$dbh = connectBDD::getDBO();
			$sql = "SELECT * FROM utilisateurs";
			$resultat = $dbh->query($sql);
			while($row=$resultat->fetch())
				{
		?>
		<div class="trombi-item">
			<a href="afficher-utilisateur.php?id=<?php echo $row['id_utilisateur']; ?>">
				<img src="<?php echo $row['photo'];?>" alt="<?php echo $row['prenom'].' '.$row['nom'];?>" />
				<p><?php echo $row['prenom'].' '.$row['nom'];?></p>
			</a>
			<form  method="POST" enctype="multipart/form-data" action="scriptPhp/supprimerUser.php" onsubmit="return confirm('Vous êtes sur le point de supprimer l\'utilisateur $row['prenom'] $row['nom']. \n Êtes-vous sûr ?')" >
				<input name="idUser" type="HIDDEN" value="<?php echo $row['id_utilisateur']; ?>">
				<input name="supprimer" type="submit" value="Supprimer" class="small radius button alert">
			</form>
		</div>
		<?php
			}
		?>

	</section>
	
	<div class="clear"></div>

<?php
	include_once('footer.inc.php');
?>