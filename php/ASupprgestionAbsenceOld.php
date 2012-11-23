<?php
	include_once('session.inc.php');
?>
<!DOCTYPE html>

<html lang="fr">
<head>
	<meta charset="UTF-8">

	<title></title>

	<link rel="stylesheet" media="screen" href="../css/style.css">
	<link rel="stylesheet" media="screen" href="../css/style.css">
	<link rel="stylesheet" media="screen" href="../css/app.css">
	<link rel="stylesheet" media="screen" href="../css/foundation.css">
	<link rel="stylesheet" media="screen" href="../css/foundation.min.css">
	<script src="script.js"></script>
</head>
<body>
	<?php 
		include_once('header.inc.php');
		include_once('connexion.inc.php');
		
		$sql = "SELECT * FROM etudiants";
		$resultat = $dbh->query($sql);
		
		foreach($resultat as $test)
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
		
		if (empty($_SESSION['etudiant_absent']))
		{
			$_SESSION['etudiant_absent'] = array();
		}
		if (!empty($_GET['action']) && !empty($_GET['id']) && $_GET['action'] == 'select_absent')
		{
			$_SESSION['etudiant_absent'][] = $_GET['id'];
		}

		//affiche les �tuditants selectionner pour suppression
		// $etudiants_store = array(
			// 1 => array('nom' => 'bla', 'prenom' => 'bla'),
			// 10 => array('nom' => 'bla', 'prenom' => 'bla')
		// );

	
	?>
	<div id="BlocsLesAbsents" class="borderBloc">
		<p>Absent(s) du jour :</p>
		<!-- Affiche la photo de chaque etudiant absent-->
		<div class="eleveAbsent">
			<?php 
				foreach ($_SESSION['etudiant_absent'] as $v)
				{
					foreach( $etudiants as $etu){
						if($etu['id'] == $v){
						?>
							<img width="50" height="50" src="<?php echo $etu['info']['photo'];?>" alt="<?php echo $etu['info']['nom'].' '.$etu['info']['prenom'];?>" />
							<input type="HIDDEN" value="$v" name=""/>
						<?php
						}
					}
				}
			?>
			<form  method="POST" enctype="multipart/form-data" action="absence.php">
				<input type="submit" value="valider"/>
			</form>
		</div>
	</div>
	<div id="blocsLesEtudiants">
		<?php
			foreach( $etudiants as $etu){
		?>
			<a href="gestionAbsence.php?action=select_absent&id=<?php echo $etu['id']; ?>">
					<img width="150" height="150" src="<?php echo $etu['info']['photo'];?>" alt="<?php echo $etu['info']['nom'].' '.$etu['info']['prenom'];?>" />
			</a>
			<p><?php echo $etu['info']['nom'].' '.$etu['info']['prenom'];?></p>
			
				
		<?php
			}
		?>
	</div>
</body>
</html>