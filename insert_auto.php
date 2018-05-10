<?php
  session_start();
  if(!isset($_SESSION["userid"]))
    header("location: index.php");
  include "conn.inc.php";
  try
  {
    $dbh = new PDO($stringa, $username, $password);
    $stm = $dbh->prepare("INSERT INTO Auto(targa, marca, modello, cilindrata, potenza, idAutista) VALUES (:t, :ma, :mo, :c, :p, :i)");
    $stm->bindValue(":t", $_POST["targa"]);
    $stm->bindValue(":ma", $_POST["marca"]);
    $stm->bindValue(":mo", $_POST["modello"]);
    $stm->bindValue(":c", $_POST["cilindrata"]);
    $stm->bindValue(":p", $_POST["potenza"]);
    $stm->bindValue(":i", $_SESSION["userid"]);
    $stm->execute();
  }catch(PDOException $e)
  {
    echo 'Connessione fallita' . $e->getMessage();
  }
  header("location: dashboarda.php");
?>