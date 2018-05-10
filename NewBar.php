<?php
  include "conn.inc.php";
  session_start();
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php
  if(isset($_SESSION["userid"]))
  {
    $dbh = new PDO($stringa, $username, $password);
    $stm = $dbh->prepare("SELECT * FROM Autista WHERE idAutista=:id");
    $stm->bindValue(":id", $_SESSION["userid"]);
    $stm->execute();
    if($stm->rowCount()>0)
    {
      $row = $stm->fetch();
    }
    echo
      "
      <style>
        body{background-image: url('http://sf.co.ua/15/02/wallpaper-1cca76.jpg')}
      </style>
      <nav class='navbar navbar-inverse navbar-fixed-top'>
        <div class='container-fluid'>
          <div class='navbar-header'>
              <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>                        
            </button>
            <a class='navbar-brand' href='index.php'>Car Pooling</a>
          </div>

          <div>
            <div class='collapse navbar-collapse' id='myNavbar'>
              <ul class='nav navbar-nav navbar-right'>

                <li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'>" . $row["cognome"] . " " . $row["nome"] . "<span class='caret'></span></a>
                  <ul class='dropdown-menu'>
                    <li><a href='dashboarda.php'><span class='glyphicon glyphicon-dashboard'></span> Dashboard</a></li>
                    <li><a href='profilo.php'><span class='glyphicon glyphicon-user'></span> Profilo</a></li>
                    <li role='separator' class='divider'></li>
                    <li><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>
                  </ul>
                </li>
                
              </ul>
            </div>
          </div>
        </div>
      </nav>
      
      <div id='dautisti' class='container-fluid' style='margin-top: 50px'>
        <center><h1 style='margin-top: 210px; color: black;'>Dashboard</h1></center>
        <center><p style='color: black; font-size: 20px; margin-top: 45px'>
          Nella dashboard potrai gestire i viaggi, aggiungere i dati della tua macchina, 
          <br>
          gestire le prenotazioni e visualizzare il tuo profilo.
        </p></center>
        <center style='margin-top: 90px'>
          <a href='dashboarda.php' class='button' style='text-decoration: none;'>
            <span class='glyphicon glyphicon-dashboard'></span> Vai 
          </a>
        </center>
      </div>
      ";
  }

  if(isset($_SESSION["passid"]))
    {
      $dbh = new PDO($stringa, $username, $password);
      $stm = $dbh->prepare("SELECT * FROM Passeggero WHERE idPasseggero=:id");
      $stm->bindValue(":id", $_SESSION["passid"]);
      $stm->execute();
      if($stm->rowCount()>0)
      {
        $row = $stm->fetch();
      }
      echo
        "
        <style>
          body{background-image: url('https://www.idealclassiccars.net/galleria_images/93/93_main_l.jpg')}
        </style>
        <nav class='navbar navbar-inverse navbar-fixed-top'>
          <div class='container-fluid'>
            <div class='navbar-header'>
                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
                  <span class='icon-bar'></span>
                  <span class='icon-bar'></span>
                  <span class='icon-bar'></span>                        
              </button>
              <a class='navbar-brand' href='index.php'>Car Pooling</a>
            </div>

            <div>
              <div class='collapse navbar-collapse' id='myNavbar'>
                <ul class='nav navbar-nav navbar-right'>

                  <li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'>" . $row["cognome"] . " " . $row["nome"] . "<span class='caret'></span></a>
                    <ul class='dropdown-menu'>
                      <li><a href='dashboardp.php'><span class='glyphicon glyphicon-dashboard'></span> Dashboard</a></li>
                      <li><a href='profilo.php'><span class='glyphicon glyphicon-user'></span> Profilo</a></li>
                      <li role='separator' class='divider'></li>
                      <li><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>
                    </ul>
                  </li>

                </ul>
              </div>
            </div>
          </div>
        </nav>

        <div id='dautisti' class='container-fluid' style='margin-top: 50px'>
          <center><h1 style='margin-top: 210px; color: white;'>Dashboard</h1></center>
          <center><p style='color: white; font-size: 20px; margin-top: 45px'>
            Nella dashboard potrai gestire le prenotazioni, visualizzare i viaggi disponibili, 
            <br>
            e visualizzare il tuo profilo.
          </p></center>
          <center style='margin-top: 90px'>
            <a href='dashboardp.php' class='button' style='text-decoration: none;'>
              <span class='glyphicon glyphicon-dashboard'></span> Vai 
            </a>
          </center>
        </div>
        ";
    }

  if(!isset($_SESSION["userid"]) && !isset($_SESSION["passid"]))
  {
    echo
      "
      <nav class='navbar navbar-inverse navbar-fixed-top'>
        <div class='container-fluid'>
          <div class='navbar-header'>
              <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>                        
            </button>
            <a class='navbar-brand' href='index.php'>Car Pooling</a>
          </div>

          <div>
            <div class='collapse navbar-collapse' id='myNavbar'>
              <ul class='nav navbar-nav navbar-right'>

                <li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'><span class='glyphicon glyphicon-log-in'></span> SignIn<span class='caret'></span></a>
                  <ul class='dropdown-menu'>
                    <li><a href='#lautisti'>Autisti</a></li>
                    <li><a href='#lpasseggeri'>Passeggeri</a></li>
                  </ul>
                </li>

                <li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'>SignUp<span class='caret'></span></a>
                  <ul class='dropdown-menu'>
                    <li><a href='#rautisti'>Autisti</a></li>
                    <li><a href='#rpasseggeri'>Passeggeri</a></li>
                  </ul>
                </li>

              </ul>
            </div>
          </div>
        </div>
      </nav>    

      <div id='lautisti' class='container-fluid'>
        <center><h1 style='margin-top: 54px'>Accesso autisti</h1></center>
        <center style='margin-top: 160px'>
          <a href='signina.php' class='button' style='text-decoration: none;'>
            <span class='glyphicon glyphicon-log-in'></span> Accedi 
          </a>
        </center>
      </div>
      <div id='lpasseggeri' class='container-fluid'>
        <center><h1 style='color: black'>Accesso passeggeri</h1></center>
        <center style='margin-top: 160px'>
          <a href='signinp.php' class='button' style='text-decoration: none; color: black'>
            <span class='glyphicon glyphicon-log-in'></span> Accedi 
          </a>
        </center>
      </div>
      <div id='rautisti' class='container-fluid'>
        <h1 style='margin-left: 63px;'>Registrazione autisti</h1>
        <center style='margin-top: 160px'>
          <a href='signupa.php' class='button' style='text-decoration: none;'>
            <span class='glyphicon glyphicon-user'></span> Registrati 
          </a>
        </center>
      </div>
      <div id='rpasseggeri' class='container-fluid'>
        <h1 style='margin-left: 63px; color: black'>Registrazione passeggeri</h1>
        <center style='margin-top: 160px'>
          <a href='signupp.php' class='button' style='text-decoration: none; color: black'>
            <span class='glyphicon glyphicon-user'></span> Registrati 
          </a>
        </center>
      </div>
      ";
  }

?>


  <script>
    $(document).ready(function(){
      // Add scrollspy to <body>
      $('body').scrollspy({target: ".navbar", offset: 50});   

      // Add smooth scrolling on all links inside the navbar
      $("#myNavbar a").on('click', function(event) {
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
          // Prevent default anchor click behavior
          event.preventDefault();

          // Store hash
          var hash = this.hash;

          // Using jQuery's animate() method to add smooth page scroll
          // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function(){

            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
          });
        }  // End if
      });
    });
  </script>