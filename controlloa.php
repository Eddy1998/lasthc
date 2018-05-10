<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title> Car Pooling - Controllo dati </title>
  </head>
  <body>
    <script>
      function goBack()
      {
          window.history.back();
      }
    </script>
    
    <style>
      .panel > .panel-heading {background-image: none;}
    </style>
    
    <?php
      $nome = $_POST["nome"];
      $cognome = $_POST["cognome"];
      $sesso = $_POST["sesso"];
      $nazionalita = $_POST["nazionalita"];
      $password = $_POST["password"];
      $hash = md5($password);      
      $email = $_POST["email"];
      $telefono = $_POST["telefono"];
      $dataNascita = $_POST["dataNascita"];
      $numeroPatente = $_POST["numeroPatente"];
      $scadenzaPatente = $_POST["scadenzaPatente"];
      $username = $_POST["username"];
    ?>
    
    
      <div class="panel panel-default" style="width: 350px; margin-top: 50px; margin-left: 35%">
        <div class="panel-heading" style="background-color: black">
          <center><h4 style="color: white">
            Riepilogo dati
          </h4></center>
        </div>
        <div class="panel-body">
          Cognome: <?php echo $cognome; ?>
          <br><br>
          Nome: <?php echo $nome; ?>
          <br><br>
          Sesso: <?php echo $sesso; ?>
          <br><br>
          Nazionalita': <?php echo $nazionalita; ?>
          <br><br>
          Data di nascita: <?php echo $dataNascita; ?>
          <br><br>
          Telefono: <?php echo $telefono; ?>
          <br><br>
          Email: <?php echo $email; ?>
          <br><br>
          Username: <?php echo $username; ?>
          <br><br>
          Numero patente: <?php echo $numeroPatente; ?>
          <br><br>
          Scadenza patente: <?php echo $scadenzaPatente; ?>
        </div>
        <div class="panel-footer" style="background-color: black">
          <form action="esitoa.php" method="post">
            <center>
              <table>
                <tr>
                  <td style="width: 180px"><input type="button" class="btn btn-warning" name="correggi" value="Correggi" onclick="goBack()"/></td>
                  <td><input type="submit" class="btn btn-success" name="conferma" value="Registra" onclick="location.href='esito.php'" style="margin-left: 30px"/></td>
                </tr>
              </table>
            </center>
        </div>
      </div>
      <input type="hidden" name="nome" value="<?php echo $nome; ?>"/>
      <input type="hidden" name="cognome" value="<?php echo $cognome; ?>"/>
      <input type="hidden" name="sesso" value="<?php echo $sesso; ?>"/>
      <input type="hidden" name="nazionalita" value="<?php echo $nazionalita; ?>"/>
      <input type="hidden" name="dataNascita" value="<?php echo $dataNascita; ?>"/>
      <input type="hidden" name="telefono" value="<?php echo $telefono; ?>"/>
      <input type="hidden" name="numeroPatente" value="<?php echo $numeroPatente; ?>"/>
      <input type="hidden" name="scadenzaPatente" value="<?php echo $scadenzaPatente; ?>"/>
      <input type="hidden" name="email" value="<?php echo $email; ?>"/>
      <input type="hidden" name="username" value="<?php echo $username; ?>"/>
      <input type="hidden" name="password" value="<?php echo $password; ?>"/>
      <input type="hidden" name="hash" value="<?php echo $hash; ?>"/>
    </form>
  </body>
</html>