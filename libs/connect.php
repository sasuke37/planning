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

<<<<<<< HEAD
	function connectmysql(){
		$db = mysql_connect(SERVER, USER, PASSWD); 

=======
>>>>>>> c45eebc6c53af8d04ba40c76b3a813e86189259b
		// on sélectionne la base 
		mysql_select_db(BASE,$db);
	}

<<<<<<< HEAD
?>
=======
?>
>>>>>>> c45eebc6c53af8d04ba40c76b3a813e86189259b
