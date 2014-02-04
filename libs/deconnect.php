<?php 
	session_start();
	echo "vous avez été deco, Au revoir ".$_SESSION['login'];
	session_destroy();
	
	sleep(5);
	header('Location: ../index.php');
 ?>