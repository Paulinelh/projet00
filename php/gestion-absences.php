<?php 
	include_once('header.inc.php');
	include_once('Class/GestionAbsence.class.php');
	include_once('Class/Etudiant.class.php');

	/* ---- Récupération des absences du jour ---- */
	$_aEtuDejaAbsent = GestionAbsence::VerifierAbsentDuJour();
	
	if(empty($_aEtuDejaAbsent)){
            $_sEtuDejaAbsent='';
	}else{
		$_sEtuDejaAbsent='';
		foreach ($_aEtuDejaAbsent as $_sEtu){
			$_sEtuDejaAbsent .= $_sEtu['id_etudiant'].',';
		}
		$_sEtuDejaAbsent = substr($_sEtuDejaAbsent, 0, -1);
	}
	
	/*  ---- Sélection de l'ensemble des étudiants ---- */
	//////////////////// AJOUTER LE GROUPE A LA SELECTION  /////////////////////////////////////////////////////////////////////////////// 
	$_aEtu = Etudiant::selectionEtudiants();
	
	//Traitement du tableau
	foreach($_aEtu as $test)
	{
		$etudiants[] = array
		(
			'id' => $test['id_etudiant'],
			'info' => array
			(
				'nom' => $test['nom'], 
				'prenom' => $test['prenom'], 
				'photo' => $test['photo']
			)
		);
	}

	/* ---- Récupération des groupes depuis la BDD ---- */
        $dbh = connectBDD::getDBO();
		$_sId = $_SESSION['id'];
        $sql2 ="
            SELECT
               matieres.nom
            FROM
				matieres
				JOIN utilisateurs_has_matieres 
				ON ( matieres.id_matiere= utilisateurs_has_matieres.id_matiere )
			WHERE
				utilisateurs_has_matieres.id_utilisateur = $_sId
            ";
        $stmt2 = $dbh->prepare($sql2);
        $stmt2->execute();	
        $_aMatieres = $stmt2->fetchall(PDO::FETCH_COLUMN);
	/* ---- Récupération des matières depuis la BDD ---- */
        $sql ="
            SELECT
                nom
            FROM
                groupes
            ";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();	
        $_aGroupes = $stmt->fetchall(PDO::FETCH_COLUMN);
        ////////////Récupérer en fonction du prof !!!!!!!!!
		
		
		/* ---- Récupération de l'heure pour bloquer le bouton valider ou non ---- */
		$_iDateDebutMatin = 083000;
		$_iDateFinMatin = 093000;
		$_iDateDebutApresmidi = 133000;
		$_iDateFinApresmidi = 143000;
		$currentTime = (int) date('His');
		$heure = date('H:i:s');
		$date = date('d/m/Y');
?>

<!-- Contenu du site -->

	<section id="wrap">

		<h1>Gestion des absences</h1>

		<div class="gestion-absences-info">
			<p>Bienvenue <?php echo $_SESSION['nom']; ?> !<br>
			Nous sommes le <?php echo $date; ?>, il est <?php echo $heure; ?>.<br>
			Vous êtes en cours de
			<?php
	            if(empty($_aMatieres)){
	        ?>
	            <p>Aucune matière ne vous est associée. Veuillez contacter un administrateur.</p>
	        <?php
	            }else{
	                echo "<select>";
	                foreach ($_aMatieres as $_sMatiere){
	                    echo "<option  >".$_sMatiere."</option>";
	                }
	                echo "<select>";
	            }
	        ?>
			Groupe
	        <?php
	            if(empty($_aGroupes)){
	        ?>
	            <p>Aucun groupe n'a encore été ajouté. Veuillez contacter un administrateur.</p>
	        <?php
	            }else{
	                echo "<select>";
	                foreach ($_aGroupes as $_sGroupe){
	                    echo "<option value=".$row['id_statut'].">".$_sGroupe."</option>";
	                }
	                echo "<select>";
	            }
	        ?>
			</p>
		</div>
		
		
	    <div class="clear"></div>

	    <div>
	    	<?php
	    		if (isset($etudiants)) {
	    			if($etudiants != ''){
	    				foreach( $etudiants as $etu){
	    	?>
	    	<div id="<?php echo $etu['id']; ?>" class="trombi-item">
	    		<?php 
	    			//Si l'élève est absent on modifie l'opacité de la photo et grise le bouton absent
	    			$id = $etu['id'];
	    			if(preg_match("/$id/", $_sEtuDejaAbsent)){
	    		?>
	    		<img style="opacity:0.5;" id="img<?php echo $etu['id']; ?>" src="<?php echo $etu['info']['photo'];?>" alt="<?php echo $etu['info']['nom'].' '.$etu['info']['prenom'];?>"/>
				<?php
					}else{
				?>
				<img id="img<?php echo $etu['id']; ?>" src="<?php echo $etu['info']['photo'];?>" alt="<?php echo $etu['info']['nom'].' '.$etu['info']['prenom'];?>"/>
				<?php
					}
				?>
				<p><?php echo $etu['info']['nom'].' '.$etu['info']['prenom'];?></p>

				<?php
					$id = $etu['id'];
					if(preg_match("/$id/", $_sEtuDejaAbsent)){
				?>
				<input type="button" value="Présent" onclick="Present(<?php echo $etu['id']; ?>);" class="present small radius button success">
				<input type="button" value="Absent" onclick="Absent(<?php echo $etu['id']; ?>);" disabled="true" class="absent small radius button alert">
				<?php
					}else{
				?>
				<input type="button" value="Présent" onclick="Present(<?php echo $etu['id']; ?>);" disabled="true" class="present small radius button success">
				<input type="button" value="Absent" onclick="Absent(<?php echo $etu['id']; ?>);" class="absent small radius button alert">
				<?php
					}
				?>
			</div>
			<?php
						}
					}
				}else{
			?>
			<p> Aucun étudiant n'a encore été ajouté. </p>
			<?php
				}
			?>
		</div>

		<div class="clear"></div>

		<?php
			if ($currentTime > $_iDateDebutMatin && $currentTime < $_iDateFinMatin || $currentTime > $_iDateDebutApresmidi && $currentTime < $_iDateFinApresmidi){
				?>
				<input type="button" value="Valider" onclick="Valider();" class="radius button success monbouton">
				<?php
			}else{
				?>
				<input type="button" value="Valider" onclick="Valider();" disabled="true" class="radius button success monbouton">
				<?php
			} 
		?>

	</section>

	<div class="clear"></div>
<!-- Fin contenu du site -->

<script src="../javascripts/gestionAbsence.js"></script>

<?php 
	include_once('footer.inc.php');
?>
