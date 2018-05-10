<?php
  include "conn.inc.php";
  session_start();
  if(isset($_SESSION["userid"]))
    header("location: dashboarda.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Car Pooling - Registrazione autista </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"/></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>
  <body>
    
    <style>
      .texts {width: 170px; }
      .val {height: 41px; text-align: center;}
      .panel > .panel-heading {background-image: none;}
    </style>
    
    <script>
      var check = function()
      {        
        if(document.getElementById('password').value == document.getElementById("cpassword").value)
          {
            document.getElementById('submit').disabled = false;            
            document.getElementById('messaggio').style.color = 'red';
            document.getElementById('messaggio').innerHTML = '';
          }
        else
          {
            document.getElementById('submit').disabled = true;
            document.getElementById('messaggio').style.color = 'red';
            document.getElementById('messaggio').innerHTML = ' Non corrisponde';
          }
        if(document.getElementById('password').value == '' || document.getElementById('cpassword').value == '')
          {
            document.getElementById('submit').disabled = true;
          }
        
      }
      
      function goBack()
      {
          window.history.back();
      }
    </script>
    
    <?php
    if(isset($_POST["conferma"]))
      header("location: controlloa.php")
    ?>
    <form class="form" name="form" action="controlloa.php" method="post">      
      <div class="panel panel-default" style="width: 400px; margin-top: 50px; margin-left: 35%;">
        <div class="panel-heading" style="background-color: black">
          <center><h4 style="color: white;">
            Signup autista
            </h4></center>         
        </div>
        <div class="panel-body">
          
          <table style="margin-left: 5%">
            <tr>
              <td>Cognome: </td>
              <td class="val"><input type="textbox" class="texts" name="cognome" required/></td>              
            </tr>
            <tr>
              <td>Nome: </td>
              <td class="val"><input type="textbox" class="texts" name="nome" required/></td>
            </tr>
            <tr>
              <td>Sesso: </td>
              <td class="val"><input type="radio" name="sesso" value="Maschile" checked required/> Maschile
              <input type="radio" name="sesso" value="Femminile" required/> Femminile</td>
            </tr>
            <tr>
              <td>Nazionalita': </td>
              <td class="val"><select class="texts" name="nazionalita" required>
              <option name="Italiana"> Italiana </option> 
              <option name="Spagnola"> Spagnola </option>
              <option name="Tedesca"> Tedesca </option>
              <option name="Inglese"> Inglese </option>
            </select></td>
            </tr>
            <tr>
              <td>Data di nascita: </td>
              <td class="val"><input type="date" class="texts" name="dataNascita" required/></td>
            </tr>
            <tr>
              <td>Telefono: </td>
              <td class="val"><input type="textbox" class="texts" name="telefono" required/></td>
            </tr>
            <tr>
              <td>Email: </td>
              <td class="val"><input type="email" class="texts" name="email" required/></td>
            </tr>
            <tr>
              <td>Username: </td>
              <td class="val"><input type="textbox" class="texts" name="username" required/></td>
            </tr>
            <tr>
              <td>Password: </td>
              <td class="val"><input type="password" id="password" class="texts" name="password" onkeyup='check();' required/></td>
            </tr>
            <tr>
              <td>Conferma password: </td>
              <td class="val"><input type="password" id="cpassword" class="texts" name="cpassword" onkeyup='check();' required/></td>
              <td><span id="messaggio"></span></td>
            </tr>
            <tr>
              <td>Numero patente: </td>
              <td class="val"><input type="textbox" class="texts" name="numeroPatente" required/></td>
            </tr>
            <tr>
              <td>Scadenza patente: </td>
              <td class="val"><input type="date" class="texts" name="scadenzaPatente" required/></td>
            </tr>
          </table>            
          
        </div>
        <div class="panel-footer" style="background-color: black">
          <table style="margin-left: 5%">
            <tr>
              <td style="width: 180px"><input type="button" class="btn btn-danger" name="annulla" value="Annulla" onclick="goBack();"/></td>
              <td><input type="submit" class="btn btn-success" id="submit" name="conferma" value="Conferma" disabled style="margin-left: 30px"/></td>
            </tr>
          </table>
        </div>
      </div>
    </form>
  </body>
</html>