<?php
  session_start();
  if(isset($_SESSION["passid"]))
    header("location: dashboardp.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"/></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="login.css">
    <title> Car Pooling - Login passeggeri </title>
  </head>
  <body>
    
    <style>
      .panel > .panel-heading {background-image: none;}
    </style>
    
    <?php
      include "conn.inc.php";
      if(isset($_POST["login"]))
      {
          $dbh = new PDO($stringa, $username, $password);
          $stm = $dbh->prepare("SELECT * FROM Passeggero WHERE username=:u AND password=MD5(:p)");
          $stm->bindValue(":u", $_POST["username"]);
          $stm->bindValue(":p", $_POST["password"]);
          $stm->execute();
          if($stm->rowCount()>0)
          {
            $row = $stm->fetch();
            $_SESSION["passid"] = $row["idPasseggero"];
            header("location: dashboardp.php");
          }
          else
            echo "Dati non corretti";
        }
        else
        { ?>
          <form action="" method="POST">
            <div class="vid-container">
              <video class="bgvid" autoplay="autoplay" muted="muted" preload="auto" loop>
                  <source src="http://videobackground.online/upload/iblock/5cb/5cbf31ba3c94707e2588a96081fb7d35.webm" type="video/webm">
              </video>
              <div class="inner-container">
                <video class="bgvid inner" autoplay="autoplay" muted="muted" preload="auto" loop>
                  <source src="http://videobackground.online/upload/iblock/5cb/5cbf31ba3c94707e2588a96081fb7d35.webm" type="video/webm">
                </video>
                <div class="box">
                  <h1>Login</h1>
                  <input type="textbox" placeholder="Username" name="username"/>
                  <input type="password" placeholder="Password" name="password"/>
                  <input type="submit" name="login" value="Login" style="background:#2ecc71; border:0; color:#fff; padding:10px; font-size:20px; width:330px; margin:20px auto; display:block; cursor:pointer;"/>
                  <p>Non sei registrato? <span onclick="location.href='signupp.php'">Sign Up</span></p>
                </div>
              </div>
            </div>
          </form>
          
    <?php
        }
    ?>
  </body>
</html>