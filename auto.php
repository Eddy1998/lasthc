<?php
  session_start();
  if(!isset($_SESSION["userid"]))
    header("location: index.php");
  include "conn.inc.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"/></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title> Car Pooling - Dati auto </title>
  </head>
  <body>
    <style>
      .tabella {margin-left: 36%; margin-top: 5%; }
      .panel > .panel-heading {background-image: none;}
    </style>
    
    <script>
      function goBack()
      {
          window.history.back();
      }
    </script>
    
    <form name="form" action="insert_auto.php" method="post">      
      <div class="panel panel-default" style="width: 400px; margin-top: 50px; margin-left: 35%">
        <div class="panel-heading" style="background-color: black">
          <center>
            <h4 style="color: white">
              Dati auto
            </h4>
          </center>
        </div>
        <div class="panel-body">
          <p>
            Targa: <input type="textbox" name="targa" style="margin-left: 70px; width: 176px;"/>              
          </p>
          <p>
            Marca: <input type="textbox" name="marca" style="margin-left: 66px;"/>
          </p>
          <p style="margin-right: 42px;">              
            Modello: <input type="textbox" name="modello" style="margin-left: 56px"/>
          </p>
          <p>
            Cilindrata: <input type="number" name="cilindrata" style="margin-left: 47px"/>
          </p>
          <p>
            Potenza: <input type="textbox" name="potenza" style="margin-left: 55px"/>
          </p>
          <p>
            <?php
              $dbh = new PDO($stringa, $username, $password);
              $stm = $dbh->prepare("SELECT idAutista, cognome, nome FROM Autista WHERE username=:u");
              $stm->bindValue(":u", $_SESSION["userid"]);
              $stm->execute();
              if($stm->rowCount() > 0)
              {
                $row = $stm->fetch();
                ?>
                Autista: <input type="textbox" name="nomeAutista" value="<?php echo $row["cognome"] . " " . $row["nome"];?>" style="margin-left: 63px" readonly/>
                <input type="hidden" name="id_autista" value="<?php echo $row["idAutista"];?>"/>
              <?php
              }
              ?>            
          </p>
        </div>
        <div class="panel-footer" style="background-color: black">
          <center><input type="button" class="btn btn-danger" name="annulla" onclick='goBack()' value="Annulla"/> <input type="submit" class="btn btn-success" name="conferma" value="Conferma"/></center>
        </div>
      </div>
    </form>
  </body>
</html>