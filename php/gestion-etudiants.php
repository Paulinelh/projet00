<?php
	include_once('header.inc.php');
?>

	<section id="wrap">

		<h1>Gestion des étudiants</h1>

		<!-- Aller à la page Ajouter un étudiant -->
		<div class="btAjoutEtu">
			<a href="ajouter-etudiant.php" class="radius button">Ajouter</a>
		</div>

		<div class="clear"></div>

		<?php
			$dbh = connectBDD::getDBO();
			$sql = "SELECT * FROM etudiants";
			$resultat = $dbh->query($sql);
			while($row=$resultat->fetch())
				{
		?>
		<div class="trombi-item">
			<a href="afficher-etudiant.php?id=<?php echo $row['id_etudiant']; ?>">
				<img src="<?php echo $row['photo'];?>" alt="<?php echo $row['prenom'].' '.$row['nom'];?>">
				<p><?php echo $row['prenom'].' '.$row['nom'];?></p>
			</a>
			<form  method="POST" action="scriptPhp/supprimerEtu.php" onsubmit="return confirm('Vous êtes sur le point de supprimer l\'étudiant $row['prenom'] $row['nom']. \n Êtes-vous sûr ?')" >
				<input name="idEtu" type="HIDDEN" enctype="multipart/form-data" value="<?php echo $row['id_etudiant'];; ?>">
				<input name="supprimer" type="submit" value="Supprimer" class="small radius button alert">
			</form>
		</div>
		<?php
			}
		?>	

		<div class="clear"></div>

		<div>
			<input name="btSupprTousEtu" type="submit" value="Supprimer tous les étudiants" class="radius button alert" onclick="alert('Cette fonctionalité sera prochainement mise en service.');">
		</div>

		<div class="clear"></div>
	
	</section>
	
	<div class="clear"></div>

<?php
	include_once('footer.inc.php');
?>