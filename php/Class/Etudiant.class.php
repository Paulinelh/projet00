<?php
include_once("connectBDD.class.php");

class Etudiant {
	public function __construct() {
		
	}
	
	public static function selectionEtudiants(){
		$dbh = connectBDD::getDBO();
		$sql = "SELECT * FROM etudiants";
		$_aEtu = $dbh->query($sql);
		
		return $_aEtu;
	}
}

?>
