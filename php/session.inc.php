<?php
	session_start();
	if($_SESSION['connexion'] != 'ok'){
		header('Location: index.php?error=2');
	}
?>