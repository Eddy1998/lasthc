<?php
  include "conn.inc.php";
  session_start();
?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"/></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php
  if(isset($_SESSION["userid"]) || isset($_SESSION["passid"]))
  {
    if(isset($_SESSION["userid"]))
    {
      $dbh = new PDO($stringa, $username, $password);
      $stm = $dbh->prepare("SELECT * FROM Autista WHERE username=:u");
      $stm->bindValue(":u", $_SESSION["userid"]);
      $stm->execute();
      if($stm->rowCount() > 0)
      {
        $row = $stm->fetch();
        echo
        "<nav class='navbar navbar-inverse'>
          <div class='container-fluid'>

            <div class='navbar-header'>          
              <a class='navbar-brand' href='index.php'>Car Pooling</a>
            </div>

            <div class='collapse navbar-collapse' id='navcollapse'>

              <ul class='nav navbar-nav navbar-right'>
                <li class='dropdown'>
                  <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'> Ciao " . $row["nome"] . "! <span class='caret'></span></a>
                  <ul class='dropdown-menu'>
                    <li><a href='signina.php'> Profilo </a></li>
                    <li><a href='dashboarda.php'> Dashboard </a></li>
                    <li role='separator' class='divider'></li>
                    <li><a href='logout.php'>Logout</a></li>
                  </ul>
                </li>
              </ul>
              
            </div>

          </div>
        </nav>";
      }
    }
    else if($_SESSION["passid"])
    {
      
    }
  }
  else
  {
    echo 
      "<nav class='navbar navbar-inverse'>
        <div class='container-fluid'>

              <div class='navbar-header'>
                <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navcollapse' aria-expanded='false'>
                  <span class='sr-only'>Toggle navigation</span>
                  <span class='icon-bar'></span>
                  <span class='icon-bar'></span>
                  <span class='icon-bar'></span>
                </button>
                <a class='navbar-brand' href='index.php'>Car Pooling</a>
              </div>


              <div class='collapse navbar-collapse' id='navcollapse'>

                <ul class='nav navbar-nav navbar-right'>
                  <li class='dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'> Login <span class='caret'></span></a>
                    <ul class='dropdown-menu'>
                      <li><a href='signina.php'>Login autisti</a></li>
                      <li><a href='signinp.php'>Login passeggeri</a></li>
                    </ul>
                  </li>
                </ul>

                <ul class='nav navbar-nav navbar-right'>
                  <li class='dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'> Signup <span class='caret'></span></a>
                    <ul class='dropdown-menu'>
                      <li><a href='signupa.php'> Signup autisti</a></li>
                      <li><a href='signupp.php'> Signup passeggeri</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

          </div>
        </nav>";
  }
?>