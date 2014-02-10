<?php
	require_once('./includes/config.php');

	function connectBD(){
		$dns="mysql:dbname=".BASE.";host=".SERVER;

		try{
			$con = new PDO($dns, USER, PASSWD);
		}
		catch(PDOExceptin $e) {
			$erreur = "Erreur de connexion base de données";
			exit();
		}
		return $con;
	}

	function connectmysql(){
		$db = mysql_connect(SERVER, USER, PASSWD); 
		mysql_select_db(BASE,$db);
	}

?>