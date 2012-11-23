<html lang="fr">
<head>
	<meta charset="UTF-8">

	<title></title>

	<link rel="stylesheet" media="screen" href="../css/style.css">
	<link rel="stylesheet" media="screen" href="../css/app.css">
	<link rel="stylesheet" media="screen" href="../css/foundation.css">
	<link rel="stylesheet" media="screen" href="../css/foundation.min.css">
	<script src="../javascripts/jquery.js"></script>
</head>
<body>
	<section>
		<form id="identification" action="scriptPhp/connexion.php" method="POST">
			<div>
				<label for="identifiant">Identifiant :</label> 
				<input id="identifiant" name="identifiant" type="text" placeholder="identifiant">
			</div>
			<div>
				<label for="motdepasse">Mot de passe :</label>
				<input id="motdepasse" name="motdepasse" type="password" placeholder="Mot de passe">
			</div>
			<p><input id="connexion" name="connexion" type="submit" value="Connexion"></p>
		</form>
		<?php
			if (isset($_GET["error"])) {
				if($_GET["error"] == 0){
					echo 'Mot de passe ou Identifiant incorrect';
				}else if($_GET["error"] == 1){
					echo 'Veuillez remplir tous les champs';
				}else if($_GET["error"] == 2){
					echo 'Vous devez vous connectez pour accedez au site';
				}
			}
			if (isset($_GET["deconnexion"])) {
				echo 'Vous avez été connecté du site avec succès.';
			}
		?>
	</section>
<?php 
	include_once('close.inc.php');
?>