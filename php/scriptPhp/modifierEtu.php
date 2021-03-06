  <?php
	include_once("../Class/connectBDD.class.php");
	$dbh = connectBDD::getDBO();
	
	//R�cup�ration de l'id dans l'url
	$idEtu = $_GET["id"];
	
	/* ------------- Gestion de la photo ------------- */
	//V�rification qu'une photo est bien ajout� : 
	if($_FILES['photo']['name'] != '' && $_FILES['photo']['error'] == 0){
		//r�cup�ration des informations sur la photo :
		$photo = $_FILES['photo']['name'];
		$taille = $_FILES['photo']['size'];
		$tmp = $_FILES['photo']['tmp_name'];
		$type = $_FILES['photo']['type'];
		$erreur = $_FILES['photo']['error'];
		
		//Affichage de ses information 
		echo "Nom d'origine => $photo <br />";
		echo "Taille => $taille <br />";
		echo "Add temp sur serv => $tmp <br />";
		echo "Type => $type <br />";
		echo "Code erreur => $erreur <br />";
		
		//D�placement du fichier upload� du r�pertoire temporaire � un r�pertoire du serveur.
		if( $type == 'image/png' || $type == 'image/gif' || $type == 'image/jpeg' || $type == 'image/jpg'){
			$nom_fichier = $_FILES['photo']['tmp_name'];
			$nom_destination = '../images/'.$photo;
			move_uploaded_file($nom_fichier, $nom_destination);
		}
	}else{
		$nom_destination = '../images/futurPhotoEtu.png';
	}
	
	/* ------------- Gestion de l'entreprise -------------*/
	//On v�rifie qu'il y a une entreprise � ajouter
	if(
		$_POST['nomEnt'] != '' || 
		$_POST['tuteur'] != '' || 
		$_POST['telephoneEnt'] != '' || 
		$_POST['portableEnt'] != '' || 
		$_POST['emailEnt'] != '' || 
		$_POST['adresseEnt'] != '' || 
		$_POST['codepostalEnt'] != '' || 
		$_POST['communeEnt'] != ''
	){
		//Requ�te Sql qui va �tre ex�cut� :
		$sqlEnt = "
			UPDATE 
				entreprises 
			SET
				nom = :nom,
				tuteur = :tuteur,
				telephone = :telephone,
				portable = :portable,
				email = :email,
				adresse = :adresse,
				code_postal = :codepostal,
				commune = :commune
			WHERE id_entreprise=
			(
				SELECT id_entreprise 
				FROM etudiants 
				WHERE id_etudiant=$idEtu
			)
		";
		
		//On pr�pare la requ�te :
		$stmtEnt = $dbh->prepare($sqlEnt);

		//Ajout des donn�es dans les variables :
		$nomEnt =  $_POST['nomEnt'];
		$tuteur =  $_POST['tuteur'];
		$telephoneEnt = $_POST['telephoneEnt'];
		$portableEnt = $_POST['portableEnt'];
		$emailEnt = $_POST['emailEnt'];
		$adresseEnt = $_POST['adresseEnt'];
		$codepostalEnt = $_POST['codepostalEnt'];
		$communeEnt = $_POST['communeEnt'];
		
		//Cr�ation d'un tableau avec les informations � rentr� dans la BDD.
		$valeursEnt = array(
			':nom'=>$nomEnt,
			':tuteur'=>$tuteur,
			':telephone'=>$telephoneEnt,
			':portable'=>$portableEnt,
			':email'=>$emailEnt,
			':adresse'=>$adresseEnt,
			':codepostal'=>$codepostalEnt,
			':commune'=>$communeEnt
		);
		
		//Execution de la requ�te pr�parer avec le tableau cr�� pr�c�dement
		$stmtEnt->execute($valeursEnt);
		
		//On r�cup�re l'id de l'entreprise en cours de cr�ation.
		$idEntSql = "SELECT LAST_INSERT_ID() FROM entreprises";
		$resultatEnt = $dbh->query($idEntSql);
		$rowEnt =$resultatEnt->fetch();
		$idEnt = $rowEnt[0];
	}
	
	/* ------------- Gestion de l'�tudiant ------------- */
	if(
		$_POST['nom'] != '' || 
		$_POST['prenom'] != '' || 
		$_POST['telephone'] != '' || 
		$_POST['portable'] != '' || 
		$_POST['email'] != '' || 
		$_POST['adresse'] != '' || 
		$_POST['codepostal'] != '' || 
		$_POST['commune'] != ''
	){
		//Requ�te Sql qui va �tre ex�cut� :
		$sql = "
			UPDATE
				etudiants 
			SET 
				nom = :nom,
				prenom = :prenom,
				telephone = :telephone,
				portable = :portable,
				email = :email,
				adresse = :adresse,
				code_postal = :codepostal,
				commune = :commune,
				photo = :photo
			WHERE 
				id_etudiant=$idEtu
		";
		
		//On pr�pare la requ�te :
		$stmt = $dbh->prepare($sql);

		//Ajout des donn�es dans les variables :
		$nom =  $_POST['nom'];
		$prenom = $_POST['prenom'];
		$telephone = $_POST['telephone'];
		$portable = $_POST['portable'];
		$email = $_POST['email'];
		$adresse = $_POST['adresse'];
		$codepostal = $_POST['codepostal'];
		$commune = $_POST['commune'];	
		
		
		//Cr�ation d'un tableau avec les informations � rentr� dans la BDD.
		$valeurs = array(
			':id_entreprise'=>$idEnt,
			':nom'=>$nom,
			':prenom'=>$prenom,
			':telephone'=>$telephone,
			':portable'=>$portable,
			':email'=>$email,
			':adresse'=>$adresse,
			':codepostal'=>$codepostal,
			':commune'=>$commune,
			':photo'=>$nom_destination
		);
		
		//Execution de la requ�te pr�parer avec le tableau cr�� pr�c�dement
		$stmt->execute($valeurs);
	}
	
	//On r�cup�re l'id de l'�tudiant en cours de cr�ation.
	$idEtuSql = "SELECT LAST_INSERT_ID() FROM etudiants";
	$resultat = $dbh->query($idEtuSql);
	$row=$resultat->fetch();
	$idEtu = $row[0];
	
	/* ------------- Gestion des groupes ------------- */
	
	if(isset($_POST['groupe'])){
		
		//On cr�� un tableau avec tous les groupes qui seront lier par la suite � l'�tudiant
		$_aGroupe = $_POST['groupe'];
		
		
		//On cr�er la requ�te qui va nous servir � lier les groupe � un �tudiants
		$sqlGroupe = "
		UPDATE
			etudiants_has_groupes
		SET
			id_groupe = :idGroupe,
			id_etudiant = :idEtu
		";
		
		$stmtGroupe = $dbh->prepare($sqlGroupe);
		
		foreach ($_aGroupe as $id)
		{
			//Cr�ation d'un tableau avec les informations � rentr� dans la BDD.
			$valeursGroupe = array(
				':idGroupe'=>$id,
				':idEtu'=>$idEtu
			);
			//Execution de la requ�te pr�parer avec le tableau cr�� pr�c�dement
			$stmtGroupe->execute($valeursGroupe);
		} 
	}
	
	echo "Etudiant ajout� avec succ�s. <a href=\"afficher-etudiant.php?id=$idEtu\">Voir le profil de l'�tudiant cr��</a>"
	?>