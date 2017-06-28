<?php
define("USER", "root");
define("PASSWORD", "");
define("SERVER", "localhost");
define("BASE", "comcli");

//oracle:	$dsn = "oci:dbname=//serveur:1521/base"
//sqlite:	$dsn = "sqlite:/tmp/base.sqlite"
$dsn="mysql:dbname=".BASE.";host=".SERVER;


function connect($dsn, $user, $password){
	try{
		$connexion = new PDO($dsn,$user, $password);
	} catch (PDOException $e) {
		printf("Echec de la connexion: %s\n", $e->getMessage());
		exit();
	}
	return $connexion;
}
?>