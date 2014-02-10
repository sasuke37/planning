<?php 
	require_once('includes/config.php');

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
			$aux = md5($_POST['mdp']);
			$stmt->bindParam(':pass' , $aux); //si on met un type de criptage caster le $_POST pat le nom du type
			$stmt->execute();
						
			// $sql = "SELECT * from user where login = '".$_POST["login"]."' and passwd = '".$_POST["mdp"]."'";

			if($stmt->rowCount() != 1){
				$incorect=1;
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
		<meta charset"utf-8">
		<title>Authentification</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
		<!-- Latest compiled and minified JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

	</head>
	<body>
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<form action = "index.php" method = "post">
					
					<div class="well">
						<h4>Identifiez-vous</h4>
					</div>


					<?php 
						if(isset($incorect)) {
					?>
					 	<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong> /!\ </strong> Login ou mot de passe incorrects.<strong> /!\ </strong>
						</div>

					<?php 
						}
					?>


					<div class="form-group">
						<label for="login">Login : </label>
						<input class="form-control" type="texte" name="login" placeholder="Votre login..." value = "" />
					</div>

					<div class="form-group">
						<label for="mdp">Mot de passe : </label>
						<input class="form-control" type="password" name="mdp" placeholder="Votre mot de passe..." value = "" />
					</div>
					<div class="form-group">
						<button class="btn btn-primary" type="submit">Se Connecter</button> 
					</div>
				</form>
			</div>
		</div>

	</body>
</html>