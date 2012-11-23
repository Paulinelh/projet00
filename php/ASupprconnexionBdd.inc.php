 <?php
	// A mettre dès qu'on a besoin d'accéder à la bdd : include_once('connexionBdd.inc.php');
 
 	// Connexion à la bdd
	$dsn = 'mysql:dbname=projetlpdw;host=localhost';
	$user = 'root';
	$password = 'root';
	
	try {
		$dbh = new PDO($dsn, $user, $password);
		$dbh->exec("SET CHARACTER SET utf8");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo 'Connexion échouée : ' . $e->getMessage();
	}
?>
