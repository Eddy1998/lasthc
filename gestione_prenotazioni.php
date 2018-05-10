<?php
  session_start();
  if(!isset($_SESSION["userid"]))
    header("location: index.php");
  include "conn.inc.php";
  
?>

<!DOCTYPE html>
  <html>
    <head>
      <title> Car Pooling - Gestione prenotazioni </title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"/></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>

      <style>
        .panel > .panel-heading {background-image: none;}
        .btn-sq-sm {width: 50px !important; height: 50px !important; font-size: 10px;}
      </style>

      <script>
        function goBack()
        {
            window.history.back();
        }
      </script>

<?php
  $var = $_POST["variabile"];
  
    $dbh = new PDO($stringa, $username, $password);
    $stm = $dbh->prepare("SELECT pa.*, v.*, p.* FROM Prenotazione p INNER JOIN Autista a ON p.idAutista = a.idAutista INNER JOIN Viaggio v ON p.idViaggio = v.idViaggio INNER JOIN Passeggero pa ON 
                                                                                                                          p.idPasseggero = pa.idPasseggero WHERE p.idAutista=:id AND p.stato=:st");
    $stm->bindValue(":id", $_SESSION["userid"]);
    $stm->bindValue(":st", $var);
    $stm->execute();
    if($stm->rowCount() > 0)
    {
      $stm->setFetchMode(PDO::FETCH_ASSOC);
      $iterator = new IteratorIterator($stm);
      foreach($iterator as $row)
      {
        if($var == "Attesa")
        {
          echo
            "
              <form name='form' action='stato_prenotazione.php' method='post'>
                <div class='panel panel-default' style='width: 300px; margin-top: 50px; margin-left: 157px'>
                  <div class='panel-heading' style='background-color: black;'>
                    <center><h5 style='color: white;'>Prenotazione</h5></center>
                  </div>
                  <div class='panel-body'>
                    Passeggero: " . $row["cognome"] . " " . $row["nome"] . "<br><br>
                    Viaggio: " . $row["partenza"] . " - " . $row["destinazione"] . " <br><br>
                    Data: " . $row["data"] . " <br><br>
                    Stato prenotazione: " . $row["stato"] . "<br><br>
                    Posti disponibili: " . $row["posti"] . "
                    <input type='hidden' name='idV' value='" . $row["idViaggio"] . "'/>
                    <input type='hidden' name='idPr' value='" . $row["idPrenotazione"] . "'/>
                    <input type='hidden' name='posti' value='" . $row["posti"] . "'/>
                  </div>
                  <div class='panel-footer' style='background-color: black'>
                    <center>
                      <table>
                        <tr>
                          <td style='width: 180px'><button type='submit' class='btn btn-sq-sm btn-danger' name='rifiuta'><span class='glyphicon glyphicon-remove' style='font-size: 25px'></span></button></td>
                          <td><button type='submit' class='btn btn-sq-sm btn-success' name='accetta' style='color: white; margin-left: 30px'><span class='glyphicon glyphicon-ok' style='font-size: 25px'" . (($row["posti"] == 0) ? "disabled" : "") . "></span></button></td>
                        </tr>
                      </table>
                    </center>
                  </div>
                </div>
              </form>
            "
          ;
        }
        else
        {
          echo
            "
              <form name='form' action='elimina_prenotazione.php' method='post'>
                <div class='panel panel-default' style='width: 300px; margin-top: 50px; margin-left: 157px'>
                  <div class='panel-heading' style='background-color: black;'>
                    <center><h5 style='color: white;'>Prenotazione</h5></center>
                  </div>
                  <div class='panel-body'>
                    Passeggero: " . $row["cognome"] . " " . $row["nome"] . "<br><br>
                    Viaggio: " . $row["partenza"] . " - " . $row["destinazione"] . " <br><br>
                    Data: " . $row["data"] . " <br><br>
                    Stato prenotazione: " . $row["stato"] . "
                    <input type='hidden' name='idV' value='" . $row["idViaggio"] . "'/>
                    <input type='hidden' name='idPr' value='" . $row["idPrenotazione"] . "'/>
                    <input type='hidden' name='posti' value='" . $row["posti"] . "'/>
                  </div>
                  <div class='panel-footer' style='background-color: black'>
                    <center>
                      <button type='submit' class='btn btn-sq-sm btn-danger' name='elimina'><span class='glyphicon glyphicon-trash' style='font-size: 25px'></span></button>
                    </center>
                  </div>
                </div>
              </form>
            "
          ;
        }
      }
    }
    else
    {
      header("location: dashboarda.php");
    }
?>
    </body>
  </html>