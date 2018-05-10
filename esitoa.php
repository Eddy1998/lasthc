<?php
  include "conn.inc.php";
  try
      {
        $dbh = new PDO($stringa, $username, $password);
        $stm = $dbh->prepare("INSERT INTO Autista(cognome, nome, email, username, password, telefono, dataNascita, sesso, nazionalita, numeroPatente, scadenzaPatente) VALUES (:cognome, :nome, :email, :username, :password, :telefono, :dataNascita, :sesso, :nazionalita, :numeroPatente, :scadenzaPatente)");
        $stm->bindValue(":cognome", $_POST["cognome"]);
        $stm->bindValue(":nome", $_POST["nome"]);
        $stm->bindValue(":email", $_POST["email"]);
        $stm->bindValue(":username", $_POST["username"]);
        $stm->bindValue(":password", $_POST["hash"]);
        $stm->bindValue(":telefono", $_POST["telefono"]);
        $stm->bindValue(":dataNascita", $_POST["dataNascita"]);
        $stm->bindValue(":sesso", $_POST["sesso"]);
        $stm->bindValue(":nazionalita", $_POST["nazionalita"]);
        $stm->bindValue(":numeroPatente", $_POST["numeroPatente"]);
        $stm->bindValue(":scadenzaPatente", $_POST["scadenzaPatente"]);
        $stm->execute();
      }catch(PDOException $e)
      {
        echo 'Connessione fallita' . $e->getMessage();
      }
  header("location: index.php");
?>