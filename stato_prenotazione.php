<?php
  session_start();
  if(!isset($_SESSION["userid"]))
    header("location: index.php");
  include "conn.inc.php";


  if(isset($_POST["accetta"]))
  {
    $posti = $_POST["posti"];
    $posti--;
    $dbh = new PDO($stringa, $username, $password);
    $stm = $dbh->prepare("UPDATE Viaggio SET posti=:p WHERE idViaggio=:iv;");
    $stm->bindValue(":p", $posti);
    $stm->bindValue(":iv", $_POST["idV"]);
    $stm->execute();
    $dbh = new PDO($stringa, $username, $password);
    $stm = $dbh->prepare("UPDATE Prenotazione SET stato='Accettata' WHERE idPrenotazione=:idPr;");
    $stm->bindValue(":idPr", $_POST["idPr"]);
    $stm->execute();
    header("location: prenotazioni_autista.php");
  }
  else
  {
    $dbh = new PDO($stringa, $username, $password);
    $stm = $dbh->prepare("UPDATE Prenotazione SET stato='Rifiutata' WHERE idPrenotazione=:idPr;");
    $stm->bindValue(":idPr", $_POST["idPr"]);
    $stm->execute();
    header("location: prenotazioni_autista.php");
  }
?>