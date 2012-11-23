<?php
	include_once('connexionBdd.inc.php');
	$sql = "
	SELECT
		*
	FROM
		etudiants, 
		entreprises
	WHERE
		etudiants.id_etudiant = entreprises.id_etudiant
	";

	$resultat = $dbh->query($sql);
	while($row=$resultat->fetch()){
		var_dump($row);
	}
?>
