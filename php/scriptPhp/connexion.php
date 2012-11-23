<?php
	session_start();
	include_once("../class/connectBDD.class.php");
	
	/* Récupération des données entrées dans le formulaire */
	if($_POST['identifiant'] != '' && $_POST['motdepasse'] != '')
	{
		$identifiant = $_POST['identifiant'];
		$motdepasse = $_POST['motdepasse'];
		
		/* Regarder les e-mails et mots de passe de la table de données Utilisateurs */
		$dbh = connectBDD::getDBO();
                $sqlCo="SELECT identifiant,mot_de_passe, id_statut FROM utilisateurs WHERE identifiant='".$identifiant."'";
		$stmt = $dbh->prepare($sqlCo);
		$stmt->execute();
                $result = $stmt->fetchAll();
		
		
                if(!empty($result)){
                    /* Récupération du résultat */
                    $idStatut = $result[0][2];
                    if($result[0]['identifiant'] == $identifiant && $result[0]['mot_de_passe'] == $motdepasse){
			
			$sql = "SELECT id_statut, nom FROM statuts WHERE id_statut='".$idStatut."'";
			$stmtStatut = $dbh->prepare($sql);
			$stmtStatut->execute();
			$resultStatut = $stmtStatut->fetchAll();
			$_SESSION['statut'] = $resultStatut[0]['nom'];
			$_SESSION['connexion'] = 'ok';
			$_SESSION['id'] = $idStatut;
			header("Location: ../gestionAbsence.php");
                        
                        //echo"<script>window.location = 'gestionAbsence.php';</script>";
                    }else{
                        $message = 0;
                        header("Location: index.php?error=$message");
                       // echo"<script> window.location = 'index.php?error=$message';</script>";
                    }
                }else{
                    $message = 0;
                    header("Location: index.php?error=$message");
                    //echo"<script> window.location = 'index.php?error=$message';</script>";
                }               
	}else{
		$message = 1;
		header("Location: index.php?error=$message");
                //echo"<script> window.location = 'index.php?error=$message';</script>";
	}
?>
