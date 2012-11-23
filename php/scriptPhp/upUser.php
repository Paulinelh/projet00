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
		echo "photo par defaut ajouté <br>";
	}
	
	
	/* ------------- Gestion de l'utilisateur ------------- */
	if(
		$_POST['nom'] != '' || 
		$_POST['prenom'] != '' || 
		$_POST['telephone'] != '' || 
		$_POST['portable'] != '' || 
		$_POST['email'] != ''
	){
		//Requête Sql qui va être exécuté :
		$sql = "
		INSERT INTO 
			utilisateurs 
			(
				id_utilisateur,
				id_statut,
				nom,
				prenom,
				telephone,
				portable,
				email,
				identifiant,
				mot_de_passe,
				photo
			) 
			VALUES 
			(
				'',
				:idStatut,
				:nom,
				:prenom,
				:telephone,
				:portable,
				:email,
				:identifiant,
				:motDePasse,
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
		$identifiant = $_POST['identifiant'];
		$motDePasse = $_POST['motDePasse'];	
		$idStatut = $_POST['statut'];
		echo 'nom : '.$nom.'<br>';
		echo 'prenom : '.$prenom.'<br>';
		echo 'telephone : '.$telephone.'<br>';
		echo 'portable : '.$portable.'<br>';
		echo 'Email : '.$email.'<br>';
		echo 'Mot de passe : '.$motDePasse.'<br>';
		echo 'Id statut : '.$idStatut.'<br>';
		
		//Création d'un tableau avec les informations à rentré dans la BDD.
		$valeurs = array(
			':idStatut'=>$idStatut,
			':nom'=>$nom,
			':prenom'=>$prenom,
			':telephone'=>$telephone,
			':portable'=>$portable,
			':email'=>$email,
			':identifiant'=>$identifiant,
			':motDePasse'=>$motDePasse,
			':photo'=>$nom_destination
		);
		
		//Execution de la requète préparer avec le tableau créé précédement
		$stmt->execute($valeurs);
		
		
	}	
	
	
	/* ------------- Gestion des matières ------------- */
	if($_POST['matiere0'] != ''){
		// On récupère l'id de l'utilisateur en cours de création.
		$idUserSql = "SELECT LAST_INSERT_ID() FROM utilisateurs";
		$resultat = $dbh->query($idUserSql);
		$row=$resultat->fetch();
		$idUser = $row[0];
		
		//On créé une boucle qui permet de récupérer chaque matière et de la rentrer dans la base de données.
		for($i=0; $i<15;$i++){
			$test = 'matiere'.$i;
			if(isset($_POST[$test])){
				//On crée la requête qui va ajouter les matières créées 
				$sqlMatiere = "
					INSERT INTO 
						matieres
						(
							id_matiere,
							nom
						) 
						VALUES 
						(
							'',
							:nom
						)
				";
				//On prépare la requête
				$stmtMatiere = $dbh->prepare($sqlMatiere);

				//Création d'un tableau avec les informations à rentré dans la BDD.
				$valeursMatiere = array(
					':nom'=>$_POST[$test]
				);
				
				// Execution de la requète préparer avec le tableau créé précédement
				$stmtMatiere->execute($valeursMatiere);
				
				//On récupère l'id du groupe en cours de création.
				$lastIdGroupeSql = "SELECT LAST_INSERT_ID() FROM etudiants";
				$resultat = $dbh->query($lastIdGroupeSql);
				$row=$resultat->fetch();
				$lastIdGroupe = $row[0];
				
				//on crée qui va lier la matière à l'utilisateur
				$sqlMatiereUser = "
					INSERT INTO 
						utilisateurs_has_matieres
						(
							id_matiere,
							id_utilisateur
						) 
						VALUES 
						(
							:idMatiere,
							:idUtilisateur
						)
				";
				//On prépare la requête
				$stmtMatiereUser = $dbh->prepare($sqlMatiereUser);
				
				//Création d'un tableau avec les informations à rentré dans la BDD.
				$valeursMatiereUser = array(
					':idMatiere'=>$lastIdGroupe,
					':idUtilisateur' => $idUser,
				);
				
				// Execution de la requète préparer avec le tableau créé précédement
				$stmtMatiereUser->execute($valeursMatiereUser);
			}else{
				break;
			}
		}
	}
	
	echo "Utilisateurs ajouté avec succès. <a href=\"profilUser.php?id=$idUser\">Voir le profil de l'utilisateur créé</a>"
	?>