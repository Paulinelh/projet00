<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">

  <title></title>

  <link rel="stylesheet" media="screen" href="style.css">
</head>
<body>
<?php

	include_once('connexion.inc.php');
	try {
		$dbh = new PDO($dsn, $user, $password);
	} catch (PDOException $e) {
		echo 'Connexion échouée : ' . $e->getMessage();
	}
	echo "toto";
	$sql = "SELECT * FROM etudiants";
	$resultat = $dbh->query($sql);
	while($row=$resultat->fetch())
	{
		?>
			<img width="150" height="150" src="<?php echo $row['photo'];?>" alt="<?php echo $row['nom'].' '.$row['prenom'];?>" />
		<?php
		echo 'Nom : '.$row['nom'].'<br>';
		echo 'Prénom : '.$row['prenom'].'<br>';
	}
	?>
</body>
</html>