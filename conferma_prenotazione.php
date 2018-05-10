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
    <title> Car Pooling - Conferma prenotazione </title>
  </head>
  <body>
    
    <style>
      .panel > .panel-heading {background-image: none;}
      .val {width: 171px}
    </style>
    
    <script>
      function goBack(){
          window.history.back();
      }
    </script>
    
    <?php
      $idV = $_POST["viaggi"];
      $idP = $_SESSION["passid"];
    ?>
    <div class="panel panel-default" style="width: 340px; margin-top: 50px; margin-left: 35%">
      <div class="panel-heading" style="background-color: black">
        <center><h4 style="color: white">
            Conferma prenotazione
          </h4></center>
      </div>
      <form action="esito_prenotazione.php" method="post">
        <div class="panel-body">        
          <p style="margin-right: 42px;">
            <?php
              $dbh = new PDO($stringa, $username, $password);
              $stm = $dbh->prepare("SELECT a.* FROM Viaggio v INNER JOIN Autista a ON v.idAutista = a.idAutista WHERE idViaggio=:iv");
              $stm->bindValue(":iv", $idV);
              $stm->execute();
              if($stm->rowCount()>0)
              {
                $row = $stm->fetch();
            ?>
                Autista: <input type="textbox" name="autista" value="<?php echo $row["cognome"] . " " . $row["nome"];?>" readonly/>
                <input type="hidden" name="idA" value="<?php echo $row["idAutista"];?>"/>
            <?php
              }
            ?>
          </p>
          <p>
            <?php
              $dbh = new PDO($stringa, $username, $password);
              $stm = $dbh->prepare("SELECT * FROM Viaggio WHERE idViaggio=:iv");
              $stm->bindValue(":iv", $idV);
              $stm->execute();
              if($stm->rowCount() > 0)
              {
                $row = $stm->fetch();
            ?>
                Data: <input type="date" name="data" value="<?php echo $row["data"];?>" style="margin-left: 14px; width: 176px" readonly/>
            <?php
              }
            ?>
          </p>
          <p>
            <?php
              $dbh = new PDO($stringa, $username, $password);
              $stm = $dbh->prepare("SELECT * FROM Viaggio WHERE idViaggio=:iv");
              $stm->bindValue(":iv", $idV);
              $stm->execute();
              if($stm->rowCount()>0)
              {
                $row = $stm->fetch();
                echo "<p>Costo: " . $row["importo"] . " euro </p>";
                if($row["posti"] > 0)
                  echo "<p>Disponibile: " . $row["posti"] . " posti</p>";
                else
                {
                  echo "<p>Non ci sono posti disponibili</p>";
                }
              }
            ?>
          </p>
        </div>
        <div class="panel-footer" style="background-color: black">
          <input type="hidden" name="idV" value="<?php echo $idV; ?>"/>
            <center>
              <center>
            <table>
              <tr>
                <td style="width: 180px"><input type="button" class="btn btn-warning" name="correggi" value="Correggi" onclick="goBack()"/></td>
                <td><input type="submit" id="submit" class="btn btn-success" name="conferma" value="Registra" style="margin-left: 30px" <?php if($row["posti"] == 0){ ?> disabled <?php }?>/></td>
              </tr>
            </table>
          </center>
            </center>
          </form>
        </div>
      </div>    
  </body>
</html>