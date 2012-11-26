 <?php
	include_once("../Class/connectBDD.class.php");
	$dbh = connectBDD::getDBO();
	
	//On regarde si un utilisateur doit être supprimer :
	if(isset($_POST['idUser']))
	{
		$idUser = $_POST['idUser'];
		
		//Requête suppression dépendance 
		$sqlSuppressionDep = "
		DELETE FROM
			utilisateurs_has_matieres 
		WHERE
			id_utilisateur=$idUser
		";
		//Execution de la requête 
		$resultat = $dbh->query($sqlSuppressionDep);
		
		//requête de suppression 
		$sqlSuppressionUser = "
		DELETE FROM
			utilisateurs 
		WHERE
			id_utilisateur=$idUser
		";
		//Execution de la requête 
		$resultat = $dbh->query($sqlSuppressionUser);
	}
	echo"<script> window.location = '../gestion-utilisateurs.php';</script>";
?>