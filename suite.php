<?php 
	@include 'libs/connect.php';
	require_once('./includes/config.php');
	session_start();
	$con = connectBD();

	if(isset($_SESSION['login'])){
<<<<<<< HEAD
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
=======

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
>>>>>>> c45eebc6c53af8d04ba40c76b3a813e86189259b
	else
		header('Location: index.php');

	function supprimer($id){
		if(isset($_SESSION['login'])) {
			if(isset($_POST)) {
				if(isset($_POST['id'])) {
					$sql = "DELETE FROM activite WHERE id = " . $id;
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
	}
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
				$( "#date" ).datepicker({
					dateFormat: 'yy-mm-dd'
				});
			});
		</script>
	</head>

	<body>
		<div class="row">
			<div class="col-md-8">
				<div class="jumbotron">
					<h1>Planning</h1>
					<p>Bienvenu
						<?php 
							echo $_SESSION['login']; 
						?>
					</p>
					<button href="sqd" class="btn btn-primary">Deconnexion</button>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2 panel panel-default">
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
						$sql = "SELECT * FROM activite WHERE nomuser = '".$_SESSION['login']."'"; 
						$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); 
						while($data = mysql_fetch_assoc($req)){ 
					?>

					<tr>
						<td>
							<?php
								echo $data['nomuser'];
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
								<input type="hidden" name="id" value="<?php //echo $data['id']; ?>">
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

		<div class="row">
			<div class="col-md-8 col-md-offset-2 panel panel-default">
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
							<option>0</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>
							<option>11</option>
							<option>12</option>
							<option>13</option>
							<option>14</option>
							<option>15</option>
							<option>16</option>
							<option>17</option>
							<option>18</option>
							<option>19</option>
							<option>20</option>
							<option>21</option>
							<option>22</option>
							<option>23</option>
							<option>24</option>
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
