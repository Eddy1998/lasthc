<?php
  include "conn.inc.php";
  session_start();
  if(!isset($_SESSION["passid"]))
    header("location: index.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"/></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title> Car Pooling - Esito prenotazione </title>
  </head>
  <body>
    
    <style>
      .panel > .panel-heading {background-image: none;}
    </style>
    
    <?php
      try
      {
        $dbh = new PDO($stringa, $username, $password);
        $stm = $dbh->prepare("INSERT INTO Prenotazione (idPasseggero, idAutista, idViaggio, data, stato) VALUES (:idP, :idA, :idV, :da, 'Attesa')");
        $stm->bindValue(":idP", $_SESSION["passid"]);
        $stm->bindValue(":idA", $_POST["idA"]);
        $stm->bindValue(":idV", $_POST["idV"]);
        $stm->bindValue(":da", $_POST["data"]);
        $stm->execute();
      }catch(PDOException $e)
      {
        echo 'Connessione fallita' . $e->getMessage();
      }
    ?>
    
    
    <div class="panel panel-default" style="width: 300px; margin-top: 50px; margin-left: 35%">
        <div class="panel-heading" style="background-color: black">
          <center><h4 style="color: white">
            Esito prenotazione
          </h4></center>
        </div>
        <div class="panel-body">
          <center>Prenotazione inviata</center>
        </div>
        <div class="panel-footer" style="background-color: black">
          <center><input type="button" class="btn btn-info" name="chiudi" value="Chiudi" onclick="location.href='dashboardp.php'"/></center>
        </div>
      </div>
  </body>
</html>