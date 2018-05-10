<?php
  session_start();
  if(!isset($_SESSION["userid"]))
    header("location: index.php");
  include "conn.inc.php";


  if(isset($_POST["modifica"]))
  {
    $targa = $_POST["targa"];
    $modello = $_POST["modello"];
    $cilindrata = $_POST["cilindrata"];
    $marca = $_POST["marca"];
    $potenza = $_POST["potenza"];
    
    echo
      "
      <!DOCTYPE html>
      <html>
        <head>
          <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>
          <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' integrity='sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp' crossorigin='anonymous'>
          <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js'/></script>
          <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>
          <title> Car Pooling - Modifica auto </title>
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
    
    
          <form name='form' action='modificatoa.php' method='post'>      
            <div class='panel panel-default' style='width: 400px; margin-top: 50px; margin-left: 35%'>
              <div class='panel-heading' style='background-color: black'>
                <center><h4 style='color: white'>
                  Modifica auto
                </h4></center>
              </div>
              <div class='panel-body'>
                <p>
                Targa: <input type='textbox' class='val' name='targa' value='" . $targa . "' style='margin-left: 76px;'/>              
                </p>
                <p>
                  Marca:
                  <input type='textbox' class='val' name='marca' value='" . $marca . "' style='margin-left: 74px'/>                      
                </p>
                <p>
                  Modello: <input type='textbox' class='val' name='modello' value='" . $modello . "' style='margin-left: 63px;'/>
                </p>
                <p style='margin-right: 42px;'>              
                  Cilindrata: <input type='textbox' class='val' name='cilindrata' value='" . $cilindrata . "' style='margin-left: 53px'/>
                </p>
                <p>
                  Potenza: <input type='textbox' class='val' name='potenza' value='" . $potenza . "' style='margin-left: 61px'/>
                </p>
              </div>
              <div class='panel-footer' style='background-color: black'>
                <center>
                  <table>
                    <tr>
                      <td style='width: 180px'><input type='button' class='btn btn-danger' name='back' value='Annulla' onclick='goBack()'/></td>
                      <td><input type='submit' class='btn btn-success' name='modifica' value='Modifica' style='margin-left: 30px'/></td>
                    </tr>
                  </table>
                </center>
              </div>
            </div>
          </form>
        </body>
      </html>
      "
    ;
  }

  else
  {
    $dbh = new PDO($stringa, $username, $password);
    $stm=$dbh->prepare("DELETE FROM Auto WHERE targa=:ta");
    $stm->bindValue(":ta", $_POST["targa"]);
    $stm->execute();
    header("location: dashboarda.php");
  }
  
?>