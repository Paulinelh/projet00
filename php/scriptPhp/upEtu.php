 <?php
	include_once("../class/connectBDD.class.php");
	$dbh = connectBDD::getDBO();
	
	/* ------------- Gestion de la photo ------------- */
	//Vérification qu'une photo est bien ajouté : 
	if($_FILES['photo']['name'] != '' && $_FILES['photo']['error'] == 0){
		//récupération des informations sur la photo :
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
		
		//Déplacement du fichier uploadé du répertoire temporaire à un répertoire du serveur.
		if( $type == 'image/png' || $type == 'image/gif' || $type == 'image/jpeg' || $type == 'image/jpg'){
			$nom_fichier = $_FILES['photo']['tmp_name'];
			$nom_destination = '../images/'.$photo;
			move_uploaded_file($nom_fichier, $nom_destination);
		}
	}else{
		$nom_destination = '../images/futurPhotoEtu.png';
	}
	
	/* ------------- Gestion de l'entreprise -------------*/
	//On vérifie qu'il y a une entreprise à ajouter
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
		//Requête Sql qui va être exécuté :
		$sqlEnt = "
		INSERT INTO 
			entreprises 
			(
				id_entreprise,
				nom,
				tuteur,
				telephone,
				portable,
				email,
				adresse,
				code_postal,
				commune
			) 
			VALUES 
			(
				'',
				:nom,
				:tuteur,
				:telephone,
				:portable,
				:email,
				:adresse,
				:codepostal,
				:commune
			)
		";
		
		//On prépare la requête :
		$stmtEnt = $dbh->prepare($sqlEnt);

		//Ajout des données dans les variables :
		$nomEnt =  $_POST['nomEnt'];
		$tuteur =  $_POST['tuteur'];
		$telephoneEnt = $_POST['telephoneEnt'];
		$portableEnt = $_POST['portableEnt'];
		$emailEnt = $_POST['emailEnt'];
		$adresseEnt = $_POST['adresseEnt'];
		$codepostalEnt = $_POST['codepostalEnt'];
		$communeEnt = $_POST['communeEnt'];
		
		//Création d'un tableau avec les informations à rentré dans la BDD.
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
		
		//Execution de la requète préparer avec le tableau créé précédement
		$stmtEnt->execute($valeursEnt);
		
		//On récupère l'id de l'entreprise en cours de création.
		$idEntSql = "SELECT LAST_INSERT_ID() FROM entreprises";
		$resultatEnt = $dbh->query($idEntSql);
		$rowEnt =$resultatEnt->fetch();
		$idEnt = $rowEnt[0];
	}
	
	
	
	/* ------------- Gestion de l'étudiant ------------- */
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
		//Requête Sql qui va être exécuté :
		$sql = "
		INSERT INTO 
			etudiants 
			(
				id_etudiant,
				id_entreprise,
				nom,
				prenom,
				telephone,
				portable,
				email,
				adresse,
				code_postal,
				commune,
				photo
			) 
			VALUES 
			(
				'',
				:id_entreprise,
				:nom,
				:prenom,
				:telephone,
				:portable,
				:email,
				:adresse,
				:codepostal,
				:commune,
				:photo
			)
		";
		
		//On prépare la requête :
		$stmt = $dbh->prepare($sql);

		//Ajout des données dans les variables :
		$nom =  $_POST['nom'];
		$prenom = $_POST['prenom'];
		$telephone = $_POST['telephone'];
		$portable = $_POST['portable'];
		$email = $_POST['email'];
		$adresse = $_POST['adresse'];
		$codepostal = $_POST['codepostal'];
		$commune = $_POST['commune'];	
		
		
		//Création d'un tableau avec les informations à rentré dans la BDD.
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
		
		//Execution de la requète préparer avec le tableau créé précédement
		$stmt->execute($valeurs);
	}
	
	//On récupère l'id de l'étudiant en cours de création.
	$idEtuSql = "SELECT LAST_INSERT_ID() FROM etudiants";
	$resultat = $dbh->query($idEtuSql);
	$row=$resultat->fetch();
	$idEtu = $row[0];
	
	/* ------------- Gestion des groupes ------------- */
	
	if(isset($_POST['groupe'])){
		
		//On créé un tableau avec tous les groupes qui seront lier par la suite à l'étudiant
		$_aGroupe = $_POST['groupe'];
		
		
		//On créer la requête qui va nous servir à lier les groupe à un étudiants
		$sqlGroupe = "
		INSERT INTO 
			etudiants_has_groupes
			(
				id_groupe,
				id_etudiant
			) 
			VALUES 
			(
				:idGroupe,
				:idEtu
			)
		";
		
		$stmtGroupe = $dbh->prepare($sqlGroupe);
		
		foreach ($_aGroupe as $id)
		{
			//Création d'un tableau avec les informations à rentré dans la BDD.
			$valeursGroupe = array(
				':idGroupe'=>$id,
				':idEtu'=>$idEtu
			);
			//Execution de la requète préparer avec le tableau créé précédement
			$stmtGroupe->execute($valeursGroupe);
		} 
	}
	
	echo "Etudiant ajouté avec succès. <a href=\"profilEtu.php?id=$idEtu\">Voir le profil de l'étudiant créé</a>"
	?>