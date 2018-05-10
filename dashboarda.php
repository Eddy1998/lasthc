<?php
	session_start();
	include "conn.inc.php";
	if(!isset($_SESSION["userid"]))
		header("location: index.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Car Pooling - Dashboard autisti</title>

		<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style5.css">
		<link rel="stylesheet" href="not.css">
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
				<h4 style="margin-left: 30px">
				  Autista
				</h4>
			</div>

			<ul class="list-unstyled components" style="background-color: black;">
				<li>
					<a href="index.php"><span class="glyphicon glyphicon-home"></span> Homepage</a>
				</li>
				<li>
					<a href="crea_viaggio.php"><span class="glyphicon glyphicon-plus-sign"></span> Viaggio</a>
				</li>
				<li>
					<a href="#gestisciPrenotazioni" data-toggle="collapse" aria-expanded="false"><span class="glyphicon glyphicon-wrench"></span> Gestisci prenotazioni</a>
					<form name='form' id='myForm' action='gestione_prenotazioni.php' method='post'>
						<ul class="collapse list-unstyled" id="gestisciPrenotazioni">
							<input type="hidden" id="variabile" name="variabile" value=""/>
							<li name='attesa' onclick="myForm.variabile.value='Attesa'; myForm.submit();"><a href="#"><span class="glyphicon glyphicon-glyphicon glyphicon-question-sign" style="font-size: 15px"> Attesa
																
								<?php
									$dbh = new PDO($stringa, $username, $password);
									$stm = $dbh->prepare("SELECT * FROM Prenotazione p WHERE p.idAutista=:id AND p.stato='Attesa'");
									$stm->bindValue(":id", $_SESSION["userid"]);
									$stm->execute();
									if($stm->rowCount()>0)
										echo "<div class='notification' style='margin-left: 65px;'><span class='notText'>" . $stm->rowCount() . "</span></div>";
								?>
								</a>
								</span>
							</li>
							<li name='accettate' onclick="myForm.variabile.value='Accettata'; myForm.submit();"><a href="#"><span class="glyphicon glyphicon-ok" style="font-size: 15px"> Accettate
								
									<?php
									$dbh = new PDO($stringa, $username, $password);
									$stm = $dbh->prepare("SELECT * FROM Prenotazione p WHERE p.idAutista=:id AND p.stato='Accettata'");
									$stm->bindValue(":id", $_SESSION["userid"]);
									$stm->execute();
									if($stm->rowCount()>0)
										echo "<div class='notification'style='margin-left: 45px;'><span class='notText'>" . $stm->rowCount() . "</span></div>";
									?>
								
								</a>
								</span>
							</li>
							<li name='rifiutate' onclick="myForm.variabile.value='Rifiutata'; myForm.submit();"><a href="#"><span class="glyphicon glyphicon-remove" style="font-size: 15px"> Rifiutate
								
									<?php
									$dbh = new PDO($stringa, $username, $password);
									$stm = $dbh->prepare("SELECT * FROM Prenotazione p WHERE p.idAutista=:id AND p.stato='Rifiutata'");
									$stm->bindValue(":id", $_SESSION["userid"]);
									$stm->execute();
									if($stm->rowCount()>0)
										echo "<div class='notification'style='margin-left: 48px;'><span class='notText'>" . $stm->rowCount() . "</span></div>";
									?>
								
								</a>
								</span>
							</li>
						</ul>
					</form>
				</li>
				<!--<li>
					<a href="prenotazioni_autista.php"><span class="glyphicon glyphicon-wrench"></span> Gestisci prenotazioni</a>
				</li>!-->
				<li>
					<a href="auto.php"><span class="glyphicon glyphicon-plus-sign"></span> Auto</a>
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
									$stm = $dbh->prepare("SELECT * FROM Autista WHERE idAutista=:id");
									$stm->bindValue(":id", $_SESSION["userid"]);
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
							<center><h4 style="color: white;">Dati auto</h4></center>
						</div>
						<div class="panel-body">
							<?php
								$dbh = new PDO($stringa, $username, $password);
								$stm = $dbh->prepare("SELECT * FROM Auto WHERE idAutista=:id");
								$stm->bindValue(":id", $_SESSION["userid"]);
								$stm->execute();
								if($stm->rowCount() > 0)
								{
									$stm->setFetchMode(PDO::FETCH_ASSOC);
									$iterator = new IteratorIterator($stm);
									foreach($iterator as $row)
									{
										echo
											"
											<form name='form' action='gestisci_auto.php' method='post'>
												<div class='panel panel-default' style='width: 300px; margin-top: 50px; margin-left: 150px'>
													<div class='panel-heading' style='background-color: black;'>
														<center><h5 style='color: white;'>Auto</h5></center>
													</div>
													<div class='panel-body'>
														Targa: " . $row["targa"] . "<br><br>
														Marca: " . $row["marca"] . " <br><br>
														Modello: " . $row["modello"] . " <br><br>
														Cilindrata: " . $row["cilindrata"] . " <br><br>
														Potenza: " . $row["potenza"] . "
														<input type='hidden' name='targa' value='" . $row["targa"] . "'/>
														<input type='hidden' name='marca' value='" . $row["marca"] . "'/>
														<input type='hidden' name='modello' value='" . $row["modello"] . "'/>
														<input type='hidden' name='cilindrata' value='" . $row["cilindrata"] . "'/>
														<input type='hidden' name='potenza' value='" . $row["potenza"] . "'/>
													</div>
													<div class='panel-footer' style='background-color: black'>
															<center>
																<table>
																	<tr>
																		<td style='width: 180px'><button type='submit' class='btn btn-sq-sm btn-danger' name='elimina'><span class='glyphicon glyphicon-trash' style='font-size: 25px'></span></button></td>
																		<td><button type='submit' class='btn btn-sq-sm btn-info' name='modifica' style='margin-left: 30px'><span class='glyphicon glyphicon-wrench' style='font-size: 25px'></span></button></td>
																	</tr>
																</table>
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
							<center><h4 style="color: white;">Viaggi</h4></center>
						</div>
						<div class="panel-body">
							<?php
								$dbh = new PDO($stringa, $username, $password);
								$stm = $dbh->prepare("SELECT * FROM Viaggio WHERE idAutista=:id");
								$stm->bindValue(":id", $_SESSION["userid"]);
								$stm->execute();
								if($stm->rowCount() > 0)
								{
									$stm->setFetchMode(PDO::FETCH_ASSOC);
									$iterator = new IteratorIterator($stm);
									foreach($iterator as $row)
									{
										echo 
											"
											<form name='form' action='gestisci_viaggio.php' method='post'>
												<div class='panel panel-default' style='width: 300px; margin-top: 50px; margin-left: 157px'>
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
														<input type='hidden' name='idViaggio' value='" . $row["idViaggio"] . "'/>
														<input type='hidden' name='data' value='" . $row["data"] . "'/>
														<input type='hidden' name='partenza' value='" . $row["partenza"] . "'/>
														<input type='hidden' name='destinazione' value='" . $row["destinazione"] . "'/>
														<input type='hidden' name='oraPartenza' value='" . $row["oraPartenza"] . "'/>
														<input type='hidden' name='oraArrivo' value='" . $row["oraArrivo"] . "'/>
														<input type='hidden' name='durata' value='" . $row["durata"] . "'/>
														<input type='hidden' name='importo' value='" . $row["importo"] . "'/>
														<input type='hidden' name='posti' value='" . $row["posti"] . "'/>
														<input type='hidden' name='bagagli' value='" . $row["bagagli"] . "'/>
														<input type='hidden' name='animali' value='" . $row["animali"] . "'/>
													</div>
													<div class='panel-footer' style='background-color: black'>
														<center>
															<table>
																<tr>
																	<td style='width: 180px'><button type='submit' class='btn btn-sq-sm btn-danger' name='elimina'><span class='glyphicon glyphicon-trash' style='font-size: 25px'></span></button></td>
																	<td><button type='submit' class='btn btn-sq-sm btn-info' name='modifica' style='margin-left: 30px'><span class='glyphicon glyphicon-wrench' style='font-size: 25px'></span></button></td>
																</tr>
															</table>
														</center>
													</div>
												</div>
											</form>
											"
										;
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
