<?php
	include_once('header.inc.php');
?>
<!-- Aller à la page Ajouter un utilisateur -->
	<a href="formulaireUser.php">
		<img width="30" height="30" src="../images/boutons/add.png" alt="Ajouter un utilisateur" />
	</a>
	
	<?php
	$dbh = connectBDD::getDBO();
	$sql = "SELECT * FROM utilisateurs";
	$resultat = $dbh->query($sql);
	while($row=$resultat->fetch())
	{
		?>
			<a href="profilUser.php?id=<?php echo $row['id_utilisateur']; ?>">
				<img width="150" height="150" src="<?php echo $row['photo'];?>" alt="<?php echo $row['nom'].' '.$row['prenom'];?>" />
			</a>
			<p><?php echo $row['nom'].' '.$row['prenom'];?></p>
			<form  method="POST" enctype="multipart/form-data" action="supprimerUser.php" onsubmit="return confirm('Vous êtes sur le point de supprimer l\'utilisateur. \n Êtes vous sûr ?')" >
				<input type="HIDDEN" value="<?php echo $row['id_utilisateur']; ?>" name="idUser" >
				<input type="submit" value="Supprimer" name="supprimer" src="../images/boutons/suppr.png" width="25" height="25" >
			</form>
		<?php
	}
	?>
<?php 
	include_once('close.inc.php');
?>