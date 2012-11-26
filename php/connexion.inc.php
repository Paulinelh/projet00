 <?php
	// A mettre dès qu'on a besoin d'accéder à la bdd : include_once('connexion.inc.php');
 
 	// Connexion � la bdd
	$dsn = 'mysql:dbname=projet0v2;host=localhost';
	$user = 'root';
	$password = '';
	
	try {
		$dbh = new PDO($dsn, $user, $password);
	} catch (PDOException $e) {
		echo 'Connexion �chou�e : ' . $e->getMessage();
	}
?>