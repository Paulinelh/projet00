<?php
	include_once("../class/connectBDD.class.php");
	$dbh = connectBDD::getDBO();
	
	//On regarde si un groupe a été ajouté :
	if($_POST['nomGroupe'] != '')
	{
		//Requète Sql qui va être exécuté :
		$sqlGroupe = "
		INSERT INTO 
			groupes 
			(
				id_groupe,
				nom
			) 
			VALUES 
			(
				'',
				:nom
			)
		";
		
		//On prépare la requète :
		$stmtGroupe = $dbh->prepare($sqlGroupe);

		//Ajout des données dans les variables :
		$nomGroupe =  $_POST['nomGroupe'];
		
		//Création d'un tableau avec les informations à rentré dans la BDD.
		$valeursGroupe = array(
			':nom'=>$nomGroupe
		);
		
		//Execution de la requète préparer avec le tableau créé précédement
		$stmtGroupe->execute($valeursGroupe);
	}
	//Redirection vers la page groupe
	header('Location: ../groupe.php');  
?>