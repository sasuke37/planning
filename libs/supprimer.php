<?php 
	@include 'connect.php';

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