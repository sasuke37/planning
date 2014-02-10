<?php 
	@include 'libs/connect.php';
	session_start();
	$con = connectBD();

	if(isset($_SESSION['login'])){
		if(isset($_POST['type']) && isset($_POST['date']) && isset($_POST['heure'])){
			$id = 0;
			$query = "SELECT * FROM activite";
			foreach ($con->query($query) as $data) {
				if($data['id'] > $id) {
					$id = $data['id'];
				}
			}
			$id++;

			$date =  $_POST['date'] . " " . $_POST['heure'] . ":00:00";
			$query = "INSERT INTO activite VALUES (".$id.",'".$_SESSION['login']."','" . $date . "','".$_POST['type']."')";
			if(!$con->query($query)) {
				echo "<h2>ERREUR SQL</h2>";
				echo "<p>" . $query . "</p>";
			}
		}
	}		
	else
		header('Location: index.php');
?>

<!DOCTYPE>

<html>
	<head>
		<title>
			Planning
		</title>
		<meta charset="utf-8">
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
				$( "#date" ).datepicker({
					dateFormat: 'yy-mm-dd'
				});
			});
		</script>
	</head>

	<body>
		<div class="row">
			<div class="col-md-12 jumbotron">
				<center>
					<h1>Planning
						<br>
						<small>
							Bienvenue
							<?php 
								echo $_SESSION['login']; 
							?>
						</small>
					</h1>
					<form action="libs/deconnect.php" method="post" >
						<button type="submit" lass="btn btn-primary">Deconnexion</button>
					</form>
				</center>
			</div>
		</div>

		<div class="span6">
			<!-- <div class="col-md-8 col-md-offset-2 panel panel-default"> -->
			<div class="col-md-5">
				<div class="well">
					<h3>Planning du jour</h3>
				</div>

				<table class="table table-striped table-hover table-bordered" >
					<tr>
						<th>id</th>
						<th>Activité</th>
						<th>Date</th>
						<th></th>
					</tr>

					<?php

						connectmysql();
						$sql = "SELECT * FROM activite WHERE nomuser = '" . $_SESSION['login'] . "' AND date > '" . date("Y-m-d H:i:00") . "' AND date < '" . date("Y-m-d H:i:00" , strtotime("+1 day")) . "'";
						$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); 
						while($data = mysql_fetch_assoc($req)){ 
					?>

					<tr>
						<td>
							<?php
								echo $data['id'];
							?>
						</td>
						<td>
							<?php 
								echo $data['type'];
							?>
						</td>
						<td>
							<?php
								echo $data['date'];
							?>
						</td>
						<td>
							<form action="libs/supprimer.php" method="post">
								<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
								<button type="submit" class="btn btn-default btn-sm">
									<span class="glyphicon glyphicon-minus"></span>
								</button>
							</form>
						</td>
					</tr>

					<?php
						}
					 ?>

				</table>

			</div>
		</div>

		<div class="span6">
			<div class="col-md-6 col-md-offset-1" >
				<form action="suite.php" method="post">
					<div class="well">
						<h3>Ajouter</h3>
					</div>
					<div class="form-group">
						<label for="date">Date</label>
						<input class="form-control" id="date" type="text" name="date" required>
					</div>

					<div class="form-group">
						<label for="type">Type</label>
						<select class="form-control" name="type" required>
							<?php 
								foreach($con->query("SELECT * FROM type") as $data){
							?>
							<option value="<?php echo $data['nom']; ?>">
								<?php
									echo $data['nom']; 
								?>
							</option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="heure">Heure</label>
						<select class="form-control" name="heure">
							<?php 
								for($heure = 0 ; $heure < 24 ; $heure++){
							?>
									<option>
										<?php
											echo $heure
										?>
									</option>
							<?php
								}
							?>
						</select>

						<label for="minute">Minute</label>
						<select class="form-control" name="minute">
							<?php 
								for($minute = 0 ; $minute < 60 ; $minute++){
							?>
									<option>
										<?php
											echo $minute
										?>
									</option>
							<?php
								}
							?>
			
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Envoyer</button>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
