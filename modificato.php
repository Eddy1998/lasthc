<?php
  session_start();
  if(!isset($_SESSION["userid"]))
    header("location: index.php");
  include "conn.inc.php";
  
  $dbh = new PDO($stringa, $username, $password);
  $stm = $dbh->prepare("UPDATE Viaggio SET data=:da, partenza=:pa, destinazione=:de, oraPartenza=:op, oraArrivo=:oa, importo=:im, durata=:du, posti=:po, bagagli=:ba, animali=:an WHERE idViaggio=:idV;");
  $stm->bindValue(":da", $_POST["data"]);
  $stm->bindValue(":pa", $_POST["partenza"]);
  $stm->bindValue(":de", $_POST["destinazione"]);
  $stm->bindValue(":op", $_POST["oraPartenza"]);
  $stm->bindValue(":oa", $_POST["oraArrivo"]);
  $stm->bindValue(":im", $_POST["importo"]);
  $stm->bindValue(":du", $_POST["durata"]);
  $stm->bindValue(":po", $_POST["posti"]);
  $stm->bindValue(":ba", $_POST["bagagli"]);
  $stm->bindValue(":an", $_POST["animali"]);
  $stm->bindValue(":idV", $_POST["idViaggio"]);
  $stm->execute();
  header("location: dashboarda.php");
?>