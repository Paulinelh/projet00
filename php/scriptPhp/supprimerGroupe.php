<?php
	include_once("../class/connectBDD.class.php");
	$dbh = connectBDD::getDBO();
	
	//On regarde si un groupe doit �tes supprimer :
	if($_POST['supprimer'])
	{
		//Ajout des checkbox selectionn� dans un tableau :
		$_aGroupes = $_POST['groupe'];
		
		//Pour chaque checkbox selectionn� on supprime le groupe.
		foreach ($_aGroupes as $id)
		{
			//Requ�te suppression d�pendance 
			$sqlSuppressionDep = "
			DELETE FROM
				etudiants_has_groupes 
			WHERE
				id_groupe=$id
			";
			//Execution de la requ�te 
			$resultat = $dbh->query($sqlSuppressionDep);
			
			//requ�te de suppression 
			$sqlSuppressionGroupe = "
			DELETE FROM
				groupes 
			WHERE
				id_groupe=$id
			";
			//Execution de la requ�te 
			$resultat = $dbh->query($sqlSuppressionGroupe);
		} 
	}
	//Redirection vers la page groupe
	header('Location: ../groupe.php');  
?>