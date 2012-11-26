<?php
define('DB_HOST', 'localhost');
define('DB_DATABASE', 'projet0');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

class connectBDD
{
    private static $db;

    public static function getDBO()
    {
		try {
			self::$db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DATABASE, DB_USERNAME, DB_PASSWORD);
			self::$db->exec("SET CHARACTER SET utf8");
			self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo 'Connexion échouée : ' . $e->getMessage();
		}
        return self::$db;
    }
}
?>
