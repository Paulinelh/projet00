<?php
	include_once("../Class/connectBDD.class.php");
	$dbh = connectBDD::getDBO();
	
	//On regarde si un groupe doit êtes supprimer :
	if($_POST['idEtu'])
	{
		$idEtu = $_POST['idEtu'];
		
		//Requête suppression dépendance 
		$sqlSuppressionDep = "
		DELETE FROM
			etudiants_has_groupes 
		WHERE
			id_etudiant=$idEtu
		";
		//Execution de la requête 
		$resultat = $dbh->query($sqlSuppressionDep);
		
		//requête de suppression Etudiants
		$sqlSuppressionEtu = "
		DELETE FROM
			etudiants 
		WHERE
			id_etudiant=$idEtu
		";
		//Execution de la requête 
		$resultat = $dbh->query($sqlSuppressionEtu);
	}
	echo"<script> window.location = '../gestion-etudiants.php';</script>";
?>