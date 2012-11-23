<?php 
	include_once('header.inc.php');
	include_once('Class/GestionAbsence.class.php');
	include_once('Class/Etudiant.class.php');

	/* ---- Récupération des absences du jours ---- */
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
	
	/*  ---- Selection de l'ensemble des étudiants ---- */
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

	/* ---- Récupération des groupes depuis la bdd ---- */
        $dbh = connectBDD::getDBO();
		$_sId = $_SESSION['id'];
        $sql2 ="
            SELECT
                nom
            FROM
                matieres,
				utilisateurs_has_matieres
			WHERE
				utilisateurs_has_matieres.id_utilisateur = $_sId
            ";
        $stmt2 = $dbh->prepare($sql2);
        $stmt2->execute();	
        $_aMatieres = $stmt2->fetchall(PDO::FETCH_COLUMN);
 
	/* ---- Récupération des matières depuis la bdd ---- */
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
?>

<!-- Contenu du site -->
    <div class="two columns">
        <label>Matière : </label>
        <?php
            if(empty($_aMatieres)){
        ?>
            <p>Aucune matière ne vous est associés. Contacter un administrateur.</p>
        <?php
            }else{
                echo "<select>";
                foreach ($_aMatieres as $_sMatiere){
                    echo "<option>".$_sMatiere."</option>";
                }
                echo "<select>";
            }
        ?>
        <label>Groupe</label>
        <?php
            if(empty($_aGroupes)){
        ?>
            <p>Aucun groupe n'a encore été ajouté. Contacter un administrateur.</p>
        <?php
            }else{
                echo "<select>";
                foreach ($_aGroupes as $_sGroupe){
                    echo "<option>".$_sGroupe."</option>";
                }
                echo "<select>";
            }
        ?>
    </div>
    <button type="button" onclick="Valider();">Valider</button>
    <div id="blocsLesEtudiants">
            <?php
            if (isset($etudiants)) {
                    if($etudiants != ''){
                            foreach( $etudiants as $etu){
                                    ?>
                                    <div style="float:left; margin-right: 20px; width:190px;" id="<?php echo $etu['id']; ?>">
                                            <?php 
                                            //Si l'élève est absent on modifie l'opacité de la photo et grise le bouton absent
                                                    if(in_array( $etu['id'], $_aEtuDejaAbsent)){
                                                            ?>
                                                                    <img style="opacity:0.5;" id="img<?php echo $etu['id']; ?>" width="190" height="190" src="<?php echo $etu['info']['photo'];?>" alt="<?php echo $etu['info']['nom'].' '.$etu['info']['prenom'];?>"/>
                                                            <?php
                                                            }else{
                                                            ?>
                                                                    <img id="img<?php echo $etu['id']; ?>" width="190" height="190" src="<?php echo $etu['info']['photo'];?>" alt="<?php echo $etu['info']['nom'].' '.$etu['info']['prenom'];?>"/>
                                                            <?php
                                                    }
                                            ?>
                                            <p><?php echo $etu['info']['nom'].' '.$etu['info']['prenom'];?></p>
                                            
                                            <?php 
                                                if($_sEtuDejaAbsent != ''){
													$id = $etu['id'];
                                                    if(preg_match("/$id/", $_sEtuDejaAbsent)){ 
													?>
                                                                    <button  type="button" class="present" onclick="Present(<?php echo $etu['id']; ?>);">Present</button>
                                                                    <button  type="button" class="absent" onclick="Absent(<?php echo $etu['id']; ?>);" disabled="true">Absent</button>
                                                            <?php
                                                   
                                                    }else{
                                                            ?>
                                                                    <button  type="button" class="present" onclick="Present(<?php echo $etu['id']; ?>);" disabled="true">Present</button>
                                                                    <button  type="button" class="absent" onclick="Absent(<?php echo $etu['id']; ?>);">Absent</button>
                                                            <?php
                                                    }
                                                }else{
                                                     ?>
                                                        <button  type="button" class="present" onclick="Present(<?php echo $etu['id']; ?>);">Present</button>
                                                        <button  type="button" class="absent" onclick="Absent(<?php echo $etu['id']; ?>);">Absent</button>
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
<!-- Fin contenu du site -->

<script src="../javascripts/gestionAbsence.js"></script>
<?php 
	include_once('close.inc.php');
?>
