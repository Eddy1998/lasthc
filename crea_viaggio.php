<?php
  session_start();
  include "conn.inc.php";
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
    <title> Car Pooling - Nuovo viaggio </title>
  </head>
  <body>
    
    <style>
      .panel > .panel-heading {background-image: none;}
      .val {width: 171px}
    </style>
    
    <script>
      function goBack()
      {
          window.history.back();
      }
    </script>
    
    <form name="form" action="insert_viaggio.php" method="post">      
      <div class="panel panel-default" style="width: 400px; margin-top: 50px; margin-left: 35%">
        <div class="panel-heading" style="background-color: black">
          <center><h4 style="color: white">
            Nuovo viaggio
          </h4></center>
        </div>
        <div class="panel-body">
          <p>
          Data: <input type="date" class="val" name="data" style="margin-left: 76px;"/>              
          </p>
          <p>
            Partenza:
            <select class="val" name="partenza" style="margin-left: 49px">
              <?php
                $dbh = new PDO($stringa, $username, $password);
                $stm=$dbh->prepare("SELECT * FROM Province ORDER BY nome");
                $stm->execute();
                if($stm->rowCount()>0)
                {
                  $counter = 0;
                  while($counter != $stm->rowCount())
                  {
                    $row = $stm->fetch();
                    echo "<option class='opt' name='" . $row["nome"] . "'>" . $row["nome"] . "</option>";
                    $counter++;
                  }
                }
              ?>
            </select>
          </p>
          <p>
            Destinazione:
            <select class="val" name="destinazione" style="margin-left: 24px">
              <?php
                $dbh = new PDO($stringa, $username, $password);
                $stm=$dbh->prepare("SELECT * FROM Province ORDER BY nome");
                $stm->execute();
                if($stm->rowCount()>0)
                {
                  $counter = 0;
                  while($counter != $stm->rowCount())
                  {
                    $row = $stm->fetch();
                    echo "<option name='" . $row["nome"] . "'>" . $row["nome"] . "</option>";
                    $counter++;
                  }
                }
              ?>
            </select>
          </p>
          <p>
            Ora partenza: <input type="textbox" class="val" name="oraPartenza" style="margin-left: 23px;"/>
          </p>
          <p style="margin-right: 42px;">              
            Ora arrivo: <input type="textbox" class="val" name="oraArrivo" style="margin-left: 42px"/>
          </p>
          <p>
            Durata viaggio: <input type="textbox" class="val" name="durata" style="margin-left: 13px"/>
          </p>
          <p style="margin-right: 80px">
            Importo: <input type="textbox" class="val" name="importo" style="margin-left: 56px"/>
          </p>
          <p>
            Posti disponibili: <input type="number" class="val" name="posti" style="margin-left: 7px"/>
          </p>
          <p>
            Bagagli: <input type="radio" name="bagagli" value="Si" checked style="margin-left: 56px"/> Si
            <input type="radio" name="bagagli" value="No"/> No
          </p>
          <p>
            Animali: <input type="radio" name="animali" value="Si" checked style="margin-left: 56px"/> Si
            <input type="radio" name="animali" value="No"/> No
          </p>
        </div>
        <div class="panel-footer" style="background-color: black">
          <center>
            <table>
              <tr>
                <td style="width: 180px"><input type="button" class="btn btn-danger" name="back" value="Annulla" onclick="goBack()"/></td>
                <td><input type="submit" class="btn btn-success" name="conferma" value="Registra" style="margin-left: 30px"/></td>
              </tr>
            </table>
          </center>
        </div>
      </div>
    </form>
  </body>
</html>