<?php 
	@include 'libs/connect.php';
	$con = connectBd();

	if (!empty($_POST)){
		if(isset($_POST['login']) && isset($_POST['mdp'])){

			$query = "SELECT * from user where login =:log and passwd =:pass";
			$stmt = $con->prepare($query);
			$stmt->bindParam(':log' , $_POST['login']);
			$aux = md5($_POST['mdp']);
			$stmt->bindParam(':pass' , $aux); //si on met un type de criptage caster le $_POST pat le nom du type
			$stmt->execute();

			if($stmt->rowCount() != 1){
				$incorrect = 1;
			} 
			else{
				session_start();
				$_SESSION['login'] = $_POST["login"];
				
				header('Location: suite.php');
			}
		}
		else {
			$errorMessage = 'veuillez remplir vos identifiants !';
		}
	}
?>

<!doctype html>
<html>
	<head>
		<title>formulaire d'iddentification</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
		<!-- Latest compiled and minified JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	</head>
	<body>
		<?php 
			if (isset($errorMessage)) {
				echo $errorMessage;
			}
		?>
		<div class="col-md-8">
			<div class="jumbotron">
				<h1>Identification</h1>
				<p>Et pas de bétises ! ...</p>
			</div>
		</div>

		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<form action = "index.php" method = "post">
					
					<div class="well">
						<h4>Identifiez-vous</h4>
					</div>


					<?php 
						if(isset($incorrect)) {
					 ?>
					 	<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong> !!! </strong> Login ou mot de passe incorrects.<strong> !!! </strong>
						</div>

					 <?php } ?>


					<div class="form-group">
						<label for="login">Login : </label>
						<input class="form-control" type="texte" name="login" placeholder="Votre login..." value = "" />
					</div>

					<div class="form-group">
						<label for="mdp">Mot de passe : </label>
						<input class="form-control" type="password" name="mdp" placeholder="Votre mot de passe..." value = "" />
					</div>
					<div class="form-group">
						<button class="btn btn-primary" type="submit">Envoyer</button> 
					</div>
				</form>
			</div>
		</div>
	</body>
</html>