<?php
    require "header.php";
?>

<?php
include('functions.php');
if (!isLoggedIn()) {
	
        echo '<script>alert("Turite prisijungti!")</script>';
	header('location: index.php');
}
?>

<!doctype html>
<html lang="en">
 <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title></title>
  </head>
  <body>
      
      <div class="container">
          <div class="row">
              <div class="col">
                  <hr> <h2> Sveiki prisijunge <?php echo $_SESSION['userName'] ?> </h2></hr>
                  <hr>
                    <form action="includes/logout.inc.php" method="post">
                         <button class="btn btn-secondary btn-sm" type="submit" name="logout-submit"> Atsijungti </button>
                    </form>
                  </hr>
                  <hr>
                  <a href="user-post.php" class="btn btn-dark btn-sm mt-2"> Įkelti įrašą </a>
                  <a href="user-order.php" class="btn btn-dark btn-sm mt-2"> Mano užsakymai </a>
                  </hr>
              </div>
              <div class="col">
                <hr> <h2> Paskyros informacija </h2></hr>
                <hr>
                <h6> Vartotojo vardas: <?php echo $_SESSION['userName'] ?> </h6>
                <h6> Vartotojo el.paštas: <?php echo $_SESSION['userEmail'] ?> </h6>
                <h6> Vartotojo rolė: <?php echo $_SESSION['userRole'] ?> </h6>
              </div>
          </div>
          <div class="row">
              <div class="col">
                  <hr> <h2> Išleisti pinigai prekių grupėms </h2>
                  <?php
                    require 'includes/dbh.inc.php';
                    
                    $sniegmoney = 0;
                    $batmoney = 0;
                    $pirstmoney = 0;
                    $striukmoney = 0;
                    $query = "SELECT pavadinimas, kaina, login_vardas FROM produkto_kategorijos LEFT JOIN uzsakymas_atliktas ON produkto_kategorijos.id = uzsakymas_atliktas.items_kategorija_id";
                    $result = mysqli_query($conn,$query);
                    while ($row = $result->fetch_assoc()):
                        
                        $pav = $row["pavadinimas"];
                    
                        if($_SESSION['userName'] == $row["login_vardas"])
                        {
                            if($pav == 'Snieglentes')
                            {
                                $sniegmoney = $sniegmoney + $row["kaina"];
                            }
                            else if ($pav == 'Batai')
                            {
                                $batmoney = $batmoney + $row["kaina"];
                            }
                            else if ($pav == 'Pirstines')
                            {
                                $pirstmoney = $pirstmoney + $row["kaina"];
                            }
                            else if ($pav == 'Striukes')
                            {
                                $striukmoney =  $striukmoney + $row["kaina"];
                            }
                        }
                        
                        endwhile; 
                        
                    $query = "SELECT * FROM produkto_kategorijos ORDER BY id ASC ";
                    $result = mysqli_query($conn,$query);
                    while ($row = $result->fetch_assoc()):
                        ?> <hr> <?php echo $row["pavadinimas"]; ?> - <?php
                        $pav = $row["pavadinimas"];
                    
                        if($pav == 'Snieglentes')
                        {
                            echo $sniegmoney;
                        }
                        else if ($pav == 'Batai')
                        {
                            echo $batmoney;
                        }
                        else if ($pav == 'Pirstines')
                        {
                            echo $pirstmoney;
                        }
                        else if ($pav == 'Striukes')
                        {
                             echo $striukmoney;
                        }
                        ?> € <?php
                    endwhile;
                    ?>
              </div>
          </div>
      </div>
      
  </body>
</html>

<?php
    require "footer.php";
?>