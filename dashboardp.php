<?php
	session_start();
	include "conn.inc.php";
	if(!isset($_SESSION["passid"]))
		header("location: index.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Car Pooling - Dashboard passeggeri</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"/></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style5.css">
  </head>
  <body>
  
		<style>
			#sidebar ul.components {padding: 20px 0;border-bottom: 1px solid #000000; }
			.panel > .panel-heading {background-image: none;}
		</style>
  
	<div class="wrapper">
		<nav id="sidebar" style="background-color: black;">
			<div class="sidebar-header" style="background-color: black;">
				<h3>Dashboard</h3>
				<h4 style="margin-left: 10px">
				  Passeggero
				</h4>
			</div>

			<ul class="list-unstyled components" style="background-color: black;">
				<li>
					<a href="index.php"><span class="glyphicon glyphicon-home"></span> Homepage</a>
				</li>
				<li>
					<a href="prenotazione.php"><span class="glyphicon glyphicon-plus-sign"></span> Prenotazione</a>
				</li>
				<!--<li>
					<a href="profilo.php"><span class="glyphicon glyphicon-user"></span> Profilo</a>
				</li>!-->
				<li>
					<a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
				</li>
			</ul>
		</nav>
		<div id="content">

			<nav class="navbar navbar-default" style="width: 1593px; height: 125px; background-color: black">
				<div class="container-fluid">

					<div class="navbar-header">
						<button type="button" id="sidebarCollapse" class="navbar-btn">
							<span></span>
							<span></span>
							<span></span>
						</button>
					</div>

					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<div class="panel-heading">
							<center><h1 style="color: white;">
								<?php
									$dbh = new PDO($stringa, $username, $password);
									$stm = $dbh->prepare("SELECT * FROM Passeggero WHERE idPasseggero=:id");
									$stm->bindValue(":id", $_SESSION["passid"]);
									$stm->execute();
									if($stm->rowCount()>0)
									{
										$row = $stm->fetch();
										echo "Ciao, " . $row["cognome"] . " " . $row["nome"] . "!";
									}
								?>
								</h1></center>
						</div>
					</div>
				</div>
			</nav>
			
			
			<div class="row">
				<div class="col-md-5">
					<div class="panel panel-default">
						<div class="panel-heading" style="background-color: black;">
							<center><h4 style="color: white;">Le mie prenotazioni</h4></center>
						</div>
						<div class="panel-body">
							<?php
								$dbh = new PDO($stringa, $username, $password);
								$stm = $dbh->prepare("SELECT * FROM Prenotazione p INNER JOIN Autista a ON p.idAutista = a.idAutista INNER JOIN Viaggio v ON p.idViaggio = v.idViaggio WHERE idPasseggero=:id");
								$stm->bindValue(":id", $_SESSION["passid"]);
								$stm->execute();
								if($stm->rowCount() > 0)
								{
									$stm->setFetchMode(PDO::FETCH_ASSOC);
									$iterator = new IteratorIterator($stm);
									foreach($iterator as $row)
									{
										echo
											"
											<form name='form' action='elimina_prenotazione.php' method='post'>
												<div class='panel panel-default' style='width: 300px; margin-top: 50px; margin-left: 157px'>
													<div class='panel-heading' style='background-color: black;'>
														<center><h5 style='color: white;'>Prenotazione</h5></center>
													</div>
													<div class='panel-body'>
														Autista: " . $row["cognome"] . " " . $row["nome"] . "<br><br>
														Viaggio: " . $row["partenza"] . " - " . $row["destinazione"] . " <br><br>
														Data: " . $row["data"] . " <br><br>
														Stato prenotazione: " . $row["stato"] . "
														<input type='hidden' name='idPr' value='" . $row["idPrenotazione"] . "'/>
														<input type='hidden' name='idV' value='" . $row["idViaggio"] . "'/>
														<input type='hidden' name='posti' value='" . $row["posti"] . "'/>
														<input type='hidden' name='stato' value='" . $row["stato"] . "'/>
													</div>
													<div class='panel-footer' style='background-color: black'>
														<center>
															<button type='submit' class='btn btn-sq-sm btn-danger' name='elimina'><span class='glyphicon glyphicon-trash' style='font-size: 25px'></span></button>
														</center>
													</div>
												</div>
											</form>";
									}
								}
							?>
						</div>
					</div>
				</div>
				<div class="col-md-5" style="float: right;">
					<div class="panel panel-default">
						<div class="panel-heading" style="background-color: black;">
							<center><h4 style="color: white;">Viaggi disponibili</h4></center>
						</div>
						<div class="panel-body">
							<?php
								$dbh = new PDO($stringa, $username, $password);
								$stm = $dbh->prepare("SELECT * FROM Viaggio");
								$stm->execute();
								if($stm->rowCount() > 0)
								{
									$stm->setFetchMode(PDO::FETCH_ASSOC);
									$iterator = new IteratorIterator($stm);
									foreach($iterator as $row)
									{
										echo 
											"<div class='panel panel-default' style='width: 300px; margin-top: 50px; margin-left: 150px'>
												<div class='panel-heading' style='background-color: black;'>
													<center><h5 style='color: white;'>". $row["partenza"] . " - " . $row["destinazione"] . "</h5></center>
												</div>
												<div class='panel-body'>
													Data: " . $row["data"] . "<br><br>
													Ora partenza: " . $row["oraPartenza"] . " <br><br>
													Ora arrivo: " . $row["oraArrivo"] . " <br><br>
													Durata: " . $row["durata"] . " <br><br>
													Importo: " . $row["importo"] . " euro <br><br>
													Posti disponibili: " . $row["posti"] . " rimanenti <br><br>
													Bagagli: " . $row["bagagli"] . " <br><br>
													Animali: " . $row["animali"] . "
												</div>
										</div>";
									}
								}
							?>
						</div>
					</div>
				</div>
			</div>
			
			
		</div>
	</div>



    <!-- jQuery CDN -->
     <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
     <!-- Bootstrap Js CDN -->
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

     <script type="text/javascript">
         $(document).ready(function () {
             $('#sidebarCollapse').on('click', function () {
                 $('#sidebar').toggleClass('active');
                 $(this).toggleClass('active');
             });
         });
     </script>
  </body>
</html>