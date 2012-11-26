<?php
include_once("connectBDD.class.php");

abstract class GestionAbsence {
	/**
	 *
	 * @return $_aEtuDejaAbsent array()
	 */
	public static function VerifierAbsentDuJour(){
		$dbh = connectBDD::getDBO();
		
		$_iDateDebutMatin = 083000;
		$_iDateFinMatin = 113000;
		$_iDateDebutApresmidi = 133000;
		$_iDateFinApresmidi = 235900;
		$currentTime = (int) date('His');

		if ($currentTime > $_iDateDebutMatin && $currentTime < $_iDateFinMatin ){
			$date_debut = date("Y-m-d 08:30:00");
		}elseif ($currentTime > $_iDateDebutApresmidi && $currentTime < $_iDateFinApresmidi ){
			$date_debut = date("Y-m-d 13:30:00");
		}
		//requête pour chercher si absent à la date du jours
		$sql2 = "SELECT
					id_etudiant,
					id_absence
				FROM
					absences
				WHERE
					date_debut = \"$date_debut\"
				";
		//On prépare et execute la requête et création du tableau.
		$stmt = $dbh->prepare($sql2);
		$stmt->execute();	
		$_aEtuDejaAbsent = $stmt->fetchall(PDO::FETCH_ASSOC);
		return $_aEtuDejaAbsent;
	}
	
	public static function CoordonneEtuAbsent($_sListId){
		$dbh = connectBDD::getDBO();
		$sql = "
		SELECT
			etu.id_etudiant,
			etu.id_entreprise,
			etu.nom AS nom_etu,
			etu.prenom AS prenom_etu,
			etu.telephone AS telephone_etu,
			etu.portable AS portable_etu,
			etu.email AS email_etu,
			ent.nom AS nom_ent,
			ent.tuteur AS tuteur_ent,
			ent.telephone AS telephone_ent,
			ent.portable AS portable_ent,
			ent.email AS email_ent
		FROM
			etudiants as etu
			JOIN entreprises as ent
			ON ( ent.id_entreprise = etu.id_entreprise )
		WHERE
			etu.id_etudiant in ($_sListId)
		";
		//On prépare et execute la requête :
		$stmt = $dbh->prepare($sql);
		$stmt->execute();	
		$_aResult = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $_aResult;
	}
	/*
         * @Param : un tableau avec tous les id des étudiants dedans 
         */
	public static function ajouterAbsentBdd($_aIdEtu){
		$dbh = connectBDD::getDBO();
		//Requête Sql qui va être exécuté :
		$sql = "
		INSERT INTO 
				absences
				(
						id_absence,
						id_etudiant,
						date_debut,
						date_fin,
						statut
				) 
				VALUES 
				(
						'',
						:id_etudiant,
						:date_debut,
						:date_fin,
						:statut
				)
		";

		//On prépare la requête :
		$stmt = $dbh->prepare($sql);

		/* ------------------ Ajout des données dans les variables ------------------ */
		//Préparation de la date de début et de fin selon le matin ou l'apres midi.
		$_iDateDebutMatin = 083000;
		$_iDateFinMatin = 113000;
		$_iDateDebutApresmidi = 133000;
		$_iDateFinApresmidi = 235900;
		$currentTime = (int) date('His');

		if ($currentTime > $_iDateDebutMatin && $currentTime < $_iDateFinMatin ){
			$date_debut = date("Y-m-d 08:30:00");
			$date_fin = date("Y-m-d 11:30:00");
		}elseif ($currentTime > $_iDateDebutApresmidi && $currentTime < $_iDateFinApresmidi ){
			$date_debut = date("Y-m-d 13:30:00");
			$date_fin = date("Y-m-d 16:30:00");
		} 

		
		
		//Préparation du statut (l'étudiant étant tout juste ajouté il est obligatoirement non justifié)
		$statut = "non justifé";
		//On cherche la taille du tableau $_aIdEtuNew pour pouvoir parcourir le tableau avec une boucle for.
			//$_iTailleTab = count($_aIdEtuNew);
		$_iTailleTab = count($_aIdEtu);
		for ($i = 0; $i<$_iTailleTab; $i++){
				//Création d'un tableau avec les informations à rentré dans la BDD.
				$valeurs = array(
						':id_etudiant'=>$_aIdEtu[$i],
						':date_debut'=>$date_debut,
						':date_fin'=>$date_fin,
						':statut'=>$statut
				);
				//Execution de la requète préparer avec le tableau créé précédement
				$stmt->execute($valeurs);	
		}//END for
	}//END public static function ajouterAbsentBdd($_aIdEtu)
	
	public static function supprimerAbsentBdd($_aIdAbsence){
		$_sIdAbsenceASuppr = "";
		foreach ($_aIdAbsence as $_sIdEtu){
			$_sIdAbsenceASuppr .= $_sIdEtu.",";
		}
		$_sIdAbsenceASuppr = substr($_sIdAbsenceASuppr, 0, -1);
		
		$dbh = connectBDD::getDBO();
		$sql = "
			DELETE FROM 
					absences
			WHERE
				id_absence in ($_sIdAbsenceASuppr)
			";
		 $stmt = $dbh->prepare($sql);
		 $stmt->execute();
	}
}//END class

?>
