<?php
    
    session_start();

?>

<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Extrymas</title>
  </head>
    
    <body>
        
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">
                    <a href="index.php"> <img src="img/ride_logo.png" width="110" height="60" class="d-inline-block align-top mt-1" alt=""> </a>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php"> Pagrindinis <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="post.php"> Įrašai </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop-produktai.php"> Parduotuvė </a>
                        </li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse" id="navbarkitapuse">
                    <u1 class="navbar-nav ml-auto">
                   <?php
                        if(isset($_SESSION['userID']))
                        {
                            echo '<form class="form-inline" action="includes/logout.inc.php" method="post">
                                    <li class="nav-item"> 
                                        <button class="btn btn-dark btn-sm mt-2" type="submit" name="logout-submit"> Atsijungti </button>
                                    </li>
                                  </form>';
                            if($_SESSION['userRole'] == "admin")
                            {
                             echo '<form class="navbar-nav">
                                    <li class="nav-item">
                                        <a href="admin.php" class="btn btn-dark btn-sm mt-2"> Profilis </a>
                                    </li>
                                  </form>';
                            }
                            else if ($_SESSION['userRole'] == "vartotojas")
                            {
                                  echo '<form class="navbar-nav">
                                    <li class="nav-item">
                                        <a href="user.php" class="btn btn-dark btn-sm mt-2"> Profilis </a>
                                    </li>
                                  </form>';
                            }
                        }
                        else
                        {
                            echo '<form class="navbar-nav" action="includes/login.inc.php" method="post">
                                    <li class="nav-item">
                                        <input class="form-control form-control-sm mt-2" type="text" name="mailuid" placeholder="Vardas / El.paštas">
                                    </li>
                                    <li class="nav-item">
                                        <input class="form-control form-control-sm mt-2 ml-2" type="password" name="pwd" placeholder="Slaptažodis">
                                    </li>
                                    <li class="nav-item">
                                        <button class="btn btn-dark btn-sm mt-2 mr-2 ml-3" type="submit" name="login-submit"> Prisijungti </button>
                                    </li>
                                  </form>
                                    <form class="form-inline">
                                    <li class="nav-item">
                                        <a href="signup.php" class="btn btn-dark btn-sm mt-2"> Registruotis </a>
                                    </li>
                                    </form>';
                        }
                    ?>
                    <form class="navbar-nav">
                        <li class="nav-item">
                            <a href="shop-cart.php" class="btn btn-dark btn-sm mt-2"> Krepselis </a>
                        </li>
                    </form>
                    </u1>
                </div>
            </nav>
        </header>
        
    </body>
</html>