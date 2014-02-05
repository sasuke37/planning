<?php 
	@include 'libs/connect.php';
	session_start();
	$con = connectBD();

	if(isset($_SESSION['login'])){

	function ajout(){
		$req_idmax = "select MAX(id) in activite";
		$idmax = mysql_query($req_idmax);

		$name = $_SESSION['login'];
	}
	
	function afficher(){
		connectmysql();
		// on crée la requête SQL 
		$sql = "SELECT type, date FROM activite WHERE nomuser = '".$_SESSION['login']."'"; 
		// on envoie la requête 
		$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); 
		// on fait une boucle qui va faire un tour pour chaque enregistrement 
		while($data = mysql_fetch_assoc($req)){ 
	    		// on affiche les informations de l'enregistrement en cours 
	    		echo ' '.$data['type'].' '.$data['date'].'<br>'; 
		} 

		// on ferme la connexion à mysql 
		mysql_close(); 
	}
	
		// $datejour = date("j-n-Y");

		// $req_idmax = "select MAX(id) in activite";
		// $idmax = mysql_query($req_idmax);

		
		// $d = $_POST['jesuisladate'];
		// echo("je suis la date : ");
		// echo($d);				
	}
	else
		header('Location: authentification.php');
 ?>

<!DOCTYPE>

<html>
	<head>
		<title>

		</title>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
		<!-- Latest compiled and minified JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

		<script src="//code.jquery.com/jquery-1.9.1.js"></script>
		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script>
			$(function() {
			$( "#date" ).datepicker();
			});
		</script>
	</head>

	<body>
		<div class="row">
			<div class="col-md-8">
				<div class="jumbotron">
					<h1>Planning</h1>
					<p>Bienvenu <?php echo $_SESSION['login']; ?></p>
					<button href="sqd" class="btn btn-primary">Deconnexion</button>
				</div>
			</div>
		</div>


		<div class="row">

			<div class="col-md-6 panel panel-default">
				<div class="well">
					<p>Planning du jour</p>
				</div>
			</div>

			<div class="col-md-6 panel panel-default">
				<div class="well">
					<p>Ajouter</p>
				</div>
				<p>Date: <input type="text" id="date"></p>

				<select name = "type">
					<?php foreach($con->query("SELECT * FROM type") as $data) {?>
					<option value="<?php echo $data['id']; ?>"> <?php echo $data['nom']; ?> </option>
					<?php } ?>
				</select>

				<button type="submit" class="btn btn-primary">Envoyer</button>

				<form action = "libs/deconnect.php" method = 'POST'>
					<button class="btn btn-default" type='submit'>Deconnexion</button>
				</form>
			
			</div>

		</div>

	</body>
</html>
