<?php 
	session_start();
	if(!empty($_SESSION['login'])){
		echo "Bienvenue ici ".$_SESSION['login'];
		echo " votre SID est ".session_id();
	}
	else
		header('Location: authentification.php');
 ?>
<form action = "deconnect.php" method = 'POST'>
<input type = 'submit' value = 'deconnection'>
</from>