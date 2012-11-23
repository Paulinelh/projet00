<?php
	include_once('../Class/GestionAbsence.class.php');
	if(isset($_GET['id']) || isset($_GET['present'])){
           
		if($_GET['present'] != ''){
			$_aIdEtuPresent = explode(',', $_GET['present']);
		}
		if($_GET['absent'] != ''){
			$_aIdEtuAbsent = explode(',', $_GET['absent']);
		}
		if(isset($_aIdEtuPresent)){
			//On récupère la liste des étudiants déjà absent.
			$_aAbsentsDuJour = GestionAbsence::VerifierAbsentDuJour();
			//Si le tableau n'est pas vide on va vérifier si les ids des présents sont dans la bdd. Si c'est le cas on les supprimes de la bdd.
			if(!empty($_aAbsentsDuJour)){
				foreach($_aIdEtuPresent as $_sIdEtuPresent){
					foreach($_aAbsentsDuJour as $_aAbsent){
						if($_sIdEtuPresent == $_aAbsent['id_etudiant']){
							// Si il est dans le tableau il faut l'enlever de la bdd car il est présent.
							//Pour se faire on créer un tableau avec tous les étudiants finalement présent.
							$_aIdAbsenceASuppr[] = $_aAbsent['id_absence'];
						}
					}
				}
				//On vérifie que le nouveau tableau créer n'est pas vide et on appelle la fonction pour supprimer les absent de la bdd
				if(!empty($_aIdAbsenceASuppr)){
					GestionAbsence::supprimerAbsentBdd($_aIdAbsenceASuppr);
				}
			}
		}
		if(isset($_aIdEtuAbsent)){
			//On récupère la liste des étudiants déjà absent.
			$_aAbsentsDuJour = GestionAbsence::VerifierAbsentDuJour();
			//Si le tableau n'est pas vide on va vérifier si les id des absents sont dans la bdd. S'il ne sont pas dans la bdd on les ajoutent.
			if(!empty($_aAbsentsDuJour)){
				foreach($_aIdEtuAbsent as $_sIdEtuAbsent){
					var_dump($_aAbsentsDuJour);
					exit();
					if(!in_array($_sIdEtuAbsent, $_aAbsentsDuJour)){
						// Si il n'est pas dans le tableau il faut l'ajouter.
						// pour se faire on créer un tableau avec tous les étudians finalement absent.
						$_aIdEtuFinalementPresent[] = $_sIdEtuAbsent;
					}
				}
				// ET on fait un appelle à la fonction ajouter absent bdd ici avec le tableau des étudiants absent précédement crée.
				if(!empty($_aIdEtuFinalementPresent)){
					GestionAbsence::ajouterAbsentBdd($_aIdEtuFinalementPresent);
				}
			}else{//Si il n'y a pas d'absent dans la bdd on les ajoutes tous.
				GestionAbsence::ajouterAbsentBdd($_aIdEtuAbsent);
			}
		}
                
		//GestionAbsence::ajouterAbsentBdd($_aIdEtuAbsent);
		
                
		/*$_sListId = '';
		foreach($_aIdEtu as $_sId){
			$_sListId .= $_sId.',';
		}
		$_sListId = substr($_sListId, 0, -1);
		$_aCoordonneEtuAbs = GestionAbsence::CoordonneEtuAbsent($_sListId);*/
	
	}//END if(isset($_GET['id']))

	
	//envoieMail($_aCoordonneEtuAbs);
	function envoieMail($_aCoordonneEtuAbs){
		$mail = 'lherbette.pauline@gmail.com'; // Déclaration de l'adresse de destination.
		if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
		{
			$passage_ligne = "\r\n";
		}
		else
		{
			$passage_ligne = "\n";
		}
		//=====Déclaration des messages au format texte et au format HTML.
		$message_txt = "Bonjour Valérie, \n Voici la liste des étudiants absents accompagnés de leur coordonnées : \n";
		foreach ($_aCoordonneEtuAbs as $line){
			$message_txt .= $line['nom_etu'].' '.$line['prenom_etu'].'\n';
			$message_txt .= 'Téléphone : '.$line['telephone_etu'].'\n';
			$message_txt .= 'Portable : '.$line['portable_etu'].'\n';
			$message_txt .= 'E-mail : '.$line['email_etu'].'\n';
			$message_txt .= 'Entreprise : \n';
			$message_txt .= 'Nom entreprise : '.$line['nom_ent'].'\n';
			$message_txt .= 'Tuteur : '.$line['tuteur_ent'].'\n';
			$message_txt .= 'Téléphone : '.$line['telephone_ent'].'\n';
			$message_txt .= 'Portable : '.$line['portable_ent'].'\n';
			$message_txt .= 'E-mail : '.$line['email_ent'].'\n';
		}

		$message_html = "
		<html>
			<head>
				Bonjour Valérie, <br/> 
				Voici la liste des étudiants absents accompagnés de leur coordonnées : <br/>
			</head>
			<body>";
		foreach ($_aCoordonneEtuAbs as $line){
			$message_html .= $line['nom_etu'].' '.$line['prenom_etu'].'<br/>';
			$message_html .= '<p style="margin-left: 30px;"> Téléphone : '.$line['telephone_etu'].'<br/>';
			$message_html .= 'Portable : '.$line['portable_etu'].'<br/>';
			$message_html .= 'E-mail : '.$line['email_etu'].'<br/>';
			$message_html .= 'Entreprise : <br/>';
			$message_html .= 'Nom entreprise : '.$line['nom_ent'].'<br/>';
			$message_html .= 'Tuteur : '.$line['tuteur_ent'].'<br/>';
			$message_html .= 'Téléphone : '.$line['telephone_ent'].'<br/>';
			$message_html .= 'Portable : '.$line['portable_ent'].'<br/>';
			$message_html .= 'E-mail : '.$line['email_ent'].'</p>';
		}
			
		$message_html .= "</body>
		</html>";
		//==========

//		//=====Lecture et mise en forme de la pièce jointe.
//		$fichier   = fopen("image.jpg", "r");
//		$attachement = fread($fichier, filesize("image.jpg"));
//		$attachement = chunk_split(base64_encode($attachement));
//		fclose($fichier);
//		//==========

		//=====Création de la boundary.
		$boundary = "-----=".md5(rand());
		$boundary_alt = "-----=".md5(rand());
		//==========

		//=====Définition du sujet.
		$sujet = "Absence du jour";
		//=========

		//=====Création du header de l'e-mail.
		$header = "From: \"Moi\"<lherbette.pauline@gmail.com>".$passage_ligne;
		$header.= "Reply-to: \"Moi\" <lherbette.pauline@gmail.com>".$passage_ligne;
		$header.= "MIME-Version: 1.0".$passage_ligne;
		$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
		//==========

		//=====Création du message.
		$message = $passage_ligne."--".$boundary.$passage_ligne;
		$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
		$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
		//=====Ajout du message au format texte.
		$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_txt.$passage_ligne;
		//==========

		$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

		//=====Ajout du message au format HTML.
		$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_html.$passage_ligne;
		//==========

		//=====On ferme la boundary alternative.
		$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
		//==========



		$message.= $passage_ligne."--".$boundary.$passage_ligne;

//		//=====Ajout de la pièce jointe.
//		$message.= "Content-Type: image/jpeg; name=\"image.jpg\"".$passage_ligne;
//		$message.= "Content-Transfer-Encoding: base64".$passage_ligne;
//		$message.= "Content-Disposition: attachment; filename=\"image.jpg\"".$passage_ligne;
//		$message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
//		$message.= $passage_ligne."--".$boundary."--".$passage_ligne; 
//		//========== 
		//=====Envoi de l'e-mail.
		mail($mail,$sujet,$message,$header);

		//==========

	}
	header('Location: ../gestionAbsence.php');  
?>
