<?php
	include_once("../Class/connectBDD.class.php");
	$dbh = connectBDD::getDBO();
	
	//On regarde si un groupe doit être supprimer :
	if($_POST['supprimer'])
	{
		//Ajout des checkbox selectionné dans un tableau :
		$_aGroupes = $_POST['groupe'];
		
		//Pour chaque checkbox selectionné on supprime le groupe.
		foreach ($_aGroupes as $id)
		{
			//Requète suppression dépendance 
			$sqlSuppressionDep = "
			DELETE FROM
				etudiants_has_groupes 
			WHERE
				id_groupe=$id
			";
			//Execution de la requète 
			$resultat = $dbh->query($sqlSuppressionDep);
			
			//requète de suppression 
			$sqlSuppressionGroupe = "
			DELETE FROM
				groupes 
			WHERE
				id_groupe=$id
			";
			//Execution de la requète 
			$resultat = $dbh->query($sqlSuppressionGroupe);
		} 
	}
	//Redirection vers la page groupe
	header('Location: ../gestion-groupes.php');  
?>