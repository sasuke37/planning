<?php 
	require_once('../includes/config.php');

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

	session_start();
	$con = connectBD();
	
	if(isset($_SESSION['login'])) {
		if(isset($_POST)) {
			if(isset($_POST['id'])) {
				$sql = "DELETE FROM activite WHERE id = " . $_POST['id'];
				if(!$con->query($sql)) {
					echo "<h1>Erreur SQL</h1>";
					echo $sql;
				}
				else {
					header('Location: ../suite.php');
				}
			}
		}
	}

?>