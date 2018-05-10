<?php

  session_start();
  if(!isset($_SESSION["passid"]) || !isset($_SESSION["userid"]))
    header("location: index.php");
  include "conn.inc.php";

  $dbh = new PDO($stringa, $username, $password);
  $stm = $dbh->prepare("DELETE FROM Prenotazione WHERE idPrenotazione=:idPr");
  $stm->bindValue(":idPr", $_POST["idPr"]);
  $stm->execute();
  if($_POST["stato"] != "Rifiutata")
  {
    $posti = $_POST["posti"];
    $posti++;
    $dbh = new PDO($stringa, $username, $password);
    $stm = $dbh->prepare("UPDATE Viaggio SET posti=:p WHERE idViaggio=:idV;");
    $stm->bindValue(":p", $posti);
    $stm->bindValue(":idV", $_POST["idV"]);
    $stm->execute();
  }  
  if(isset($_SESSION["passid"]))
    header("location: dashboardp.php");
  else
    header("location: dashboarda.php");
  
?>