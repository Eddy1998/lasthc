<?php
  include "conn.inc.php";
  session_start();
  if(!isset($_SESSION["userid"]))
    header("location: index.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"/></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title> Car Pooling - Viaggio inserito </title>
  </head>
  <body>
    
    <style>
      .panel > .panel-heading {background-image: none;}
    </style>
    
    <?php
      try
      {
        $dbh = new PDO($stringa, $username, $password);
        $stm = $dbh->prepare("INSERT INTO Viaggio(data, partenza, destinazione, oraPartenza, oraArrivo, importo, durata, posti, bagagli, animali, idAutista) VALUES (:da, :pa, :de, :op, :oa, :i, :du, :p, :b, :a, :id)");
        $stm->bindValue(":da", $_POST["data"]);
        $stm->bindValue(":pa", $_POST["partenza"]);
        $stm->bindValue(":de", $_POST["destinazione"]);
        $stm->bindValue(":op", $_POST["oraPartenza"]);
        $stm->bindValue(":oa", $_POST["oraArrivo"]);
        $stm->bindValue(":i", $_POST["importo"]);
        $stm->bindValue(":du", $_POST["durata"]);
        $stm->bindValue(":p", $_POST["posti"]);
        $stm->bindValue(":b", $_POST["bagagli"]);
        $stm->bindValue(":a", $_POST["animali"]);
        $stm->bindValue(":id", $_SESSION["userid"]);
        $stm->execute();
      }catch(PDOException $e)
      {
        echo 'Connessione fallita' . $e->getMessage();
      }
    ?>
    <div class="panel panel-default" style="width: 300px; margin-top: 50px; margin-left: 35%">
        <div class="panel-heading" style="background-color: black">
          <center><h4 style="color: white">
            Viaggio inserito
            </h4></center>
        </div>
        <div class="panel-body">
          <center> Viaggio registrato correttamente </center>
        </div>
        <div class="panel-footer" style="background-color: black">
          <center>
            <input type="button" class="btn btn-info" name="chiudi" value="Dashboard" onclick="location.href='dashboarda.php'"/>
          </center>
        </div>
      </div>
  </body>
</html>