<?php 
	require_once('connect.php');

	$dns = "mysql:dbname=".BASE.";host=".SERVER;
	try{
		$connection = new PDO($dns , USER , PASSWD);
	}
	catch(PDOException $e){
		printf("echec de connection : %s\n" , $e->getMessage());
		exit();
	}

	$errorMessage = '';

	if (!empty($_POST)){
	 // les id sont transmit ? 

		if(!empty($_POST['login']) && !empty($_POST['mdp'])){
		// sont il les meme que les constante ?

			$sql = "SELECT * from user where login =:log and passwd =:pass";
			$stmt = $connection->prepare($sql);
			$stmt->bindParam(':log' , $_POST['login']);
			$stmt->bindParam(':pass' , $_POST['mdp']); //si on met un type de criptage caster le $_POST pat le nom du type
			$stmt->execute();
						
			// $sql = "SELECT * from user where login = '".$_POST["login"]."' and passwd = '".$_POST["mdp"]."'";

			if($stmt->rowCount() != 1){
				$errorMessage = 'mdp ou id incorrect !';
			} 

			else{ //tout vas bien
				// on ouvre une session
				session_start();
				// enregistre le login en session
				$_SESSION['login'] = $_POST["login"];
				// on redirige vers le fichier suite.php
				header('Location: suite.php');
		}
	}
	else{
	$errorMessage = 'veuillez remplir vos iddentifiants !';
	}
}
 ?>



<!doctype html>

<html>
<head>
	<title>formulaire d'iddentification</title>
</head>
<body>
	<?php 
	if (!empty($errorMessage)) {
		echo $errorMessage;
	}
	 ?>
	<form action = "authentification.php" method = "post">
		<fieldset>
			<legend>iddentifiez-vous</legend>
			<p>
				<label for="login">Login : </label>
				<input type="texte" name = "login" value = "" />
			</p>
			<p>
				<label for="mdp">mdp : </label>
				<input type="password" name = "mdp" value = "" />
				<input type = "submit" value = "se logguer"> 
			</p>
		</fieldset>
	</form>

</body>
</html>