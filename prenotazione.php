<?php
  include "conn.inc.php";
  session_start();
  if(!isset($_SESSION["passid"]))
    header("location: index.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Car Pooling - Prenotazione viaggio </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"/></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>
  <body>
    
    <style>
      .panel > .panel-heading {background-image: none;}
    </style>
    
    <script>
      function goBack()
      {
          window.history.back();
      }
    </script>
    
    <form name="form" action="conferma_prenotazione.php" method="post">      
      <div class="panel panel-default" style="width: 350px; margin-top: 50px; margin-left: 35%">
        <div class="panel-heading" style="background-color: black">
          <center><h4 style="color: white;">Prenotazione viaggio</h4></center>
        </div>
        <div class="panel-body">
          <p>
            <?php
              $dbh = new PDO($stringa, $username, $password);
              $stm = $dbh->prepare("SELECT cognome, nome FROM Passeggero WHERE idPasseggero=:id");
              $stm->bindValue(":id", $_SESSION["passid"]);
              $stm->execute();
              if($stm->rowCount() > 0)
              {
                $row = $stm->fetch();
                ?>
                Passeggero: <input type="textbox" name="nomePasseggero" value="<?php echo $row["cognome"] . " " . $row["nome"];?>" readonly/>
              <?php
              }
              ?>
          </p>
          <p>
            Viaggio: <select class="selectpicker" name="viaggi" style="margin-left: 28px">
            <?php
              $dbh = new PDO($stringa, $username, $password);
              $stm = $dbh->prepare("SELECT * FROM Viaggio");
              $stm->execute();
              if($stm->rowCount() > 0)
              {
                $stm->setFetchMode(PDO::FETCH_ASSOC);
                $iterator = new IteratorIterator($stm);
                foreach($iterator as $row)
                {
                  echo "<option name='" . $row["idViaggio"] . "'" . "value='" . $row["idViaggio"] . "'>" . $row["partenza"] . " - " . $row["destinazione"] . "</option>";
                }
              }
            ?>
            </select>
          </p>
        </div>
        <div class="panel-footer" style="background-color: black">
          <center>
            <table>
              <tr>
                <td style="width: 180px"><input type="button" class="btn btn-danger" name="annulla" value="Annulla" onclick="goBack()"/></td>
                <td><input type="submit" class="btn btn-success" name="conferma" value="Conferma" style="margin-left: 30px"/></td>
              </tr>
            </table>
          </center>
        </div>
      </div>
    </form>
  </body>
</html>