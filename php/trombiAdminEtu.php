<?php
	include_once('header.inc.php');
?>
<!-- Aller à la page Ajouter un étudiant -->
<a href="formulaireEtu.php">
	<img width="30" height="30" src="../images/boutons/add.png" alt="Ajouter un Etudiant" />
</a>

<?php
$dbh = connectBDD::getDBO();
$sql = "SELECT * FROM etudiants";
$resultat = $dbh->query($sql);
while($row=$resultat->fetch())
{
	?>
		<a href="profilEtu.php?id=<?php echo $row['id_etudiant']; ?>">
			<img width="150" height="150" src="<?php echo $row['photo'];?>" alt="<?php echo $row['nom'].' '.$row['prenom'];?>" />
		</a>
		<p><?php echo $row['nom'].' '.$row['prenom'];?></p>
		<form  method="POST" action="supprimerEtu.php" >
			<input type="HIDDEN" enctype="multipart/form-data" value="<?php echo $row['id_etudiant'];; ?>" name="idEtu" />
			<input type="submit" value="Supprimer" name="supprimer"/>
		</form>
	<?php
}
?>
<?php 
	include_once('close.inc.php');
?>