<?php
  session_start();
  if(!isset($_SESSION["userid"]))
    header("location: index.php");
  include "conn.inc.php";
  
  $dbh = new PDO($stringa, $username, $password);
  $stm = $dbh->prepare("UPDATE Auto SET targa=:ta, marca=:ma, modello=:mo, cilindrata=:ci, potenza=:po, idAutista=:idA;");
  $stm->bindValue(":ta", $_POST["targa"]);
  $stm->bindValue(":ma", $_POST["marca"]);
  $stm->bindValue(":mo", $_POST["modello"]);
  $stm->bindValue(":ci", $_POST["cilindrata"]);
  $stm->bindValue(":po", $_POST["potenza"]);
  $stm->bindValue(":idA", $_SESSION["userid"]);
  $stm->execute();
  header("location: dashboarda.php");
?>