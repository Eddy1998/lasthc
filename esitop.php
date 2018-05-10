<?php
  include "conn.inc.php";
  if(isset($_SESSION["passid"]))
    header("location: index.php");
  try
      {
        $dbh = new PDO($stringa, $username, $password);
        $stm = $dbh->prepare("INSERT INTO Passeggero(cognome, nome, email, username, password, telefono, dataNascita, sesso, nazionalita) VALUES (:cognome, :nome, :email, :username, :password, :telefono, :dataNascita, :sesso, :nazionalita)");
        $stm->bindValue(":cognome", $_POST["cognome"]);
        $stm->bindValue(":nome", $_POST["nome"]);
        $stm->bindValue(":email", $_POST["email"]);
        $stm->bindValue(":username", $_POST["username"]);
        $stm->bindValue(":password", $_POST["hash"]);
        $stm->bindValue(":telefono", $_POST["telefono"]);
        $stm->bindValue(":dataNascita", $_POST["dataNascita"]);
        $stm->bindValue(":sesso", $_POST["sesso"]);
        $stm->bindValue(":nazionalita", $_POST["nazionalita"]);
        $stm->execute();
      }catch(PDOException $e)
      {
        echo 'Connessione fallita' . $e->getMessage();
      }
  header("location: index.php");
?>