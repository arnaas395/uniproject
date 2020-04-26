<?php
    require "header.php";
?>

<!doctype html>
<html lang="en">
 <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        
        h2{
            text-align: center;
            color: #212529;
            background-color: #efefef;
            padding: 2%;
        }
        
        .jumbotron {
            background-image: url("img/Snowboard-banner.png");
            background-size: cover;
            height: 350px;
        }
        
    </style>
  </head>
  <body>
        <div class="container">
        </div>
                  <div class="container mt-4">
                <div class="jumbotron" >
                    <h1 class="display-4"> Arnas Radzevičius IFZK-7 </h1>
                    <p class="lead"> Ekstremalaus sporto prekių parduotuvių tinklas </p>
                    
<!--                    <p class="lead">
                        <a class="btn btn-dark btn-lg" href="#" role="button"> Daugiau </a>
                    </p>-->
                </div>
            </div>
            
            <div class="container mb-4">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title"> Sekcija 1 </h5>
                            <p class="card-text"> Čia yra trumpas aprašymas </p>
                            <a href="#" class="btn btn-dark btn-sm"> Daugiau </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title"> Sekcija 2 </h5>
                            <p class="card-text"> Čia yra trumpas aprašymas </p>
                            <a href="#" class="btn btn-dark btn-sm"> Daugiau </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title"> Sekcija 3 </h5>
                            <p class="card-text"> Čia yra trumpas aprašymas </p>
                            <a href="#" class="btn btn-dark btn-sm"> Daugiau </a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
      
 <?php
    
    require 'includes/dbh.inc.php';
    if(isset($_SESSION['userID']))
    {
        $name = $_SESSION['userName'];
        $yra = '';
        $q = "SELECT login_vardas FROM uzsakymas_atliktas WHERE login_vardas='$name'";
            if ($result = $conn->query($q)) 
            {
                while ($row = $result->fetch_assoc()) 
                    {
                        $yra = $row['login_vardas']; 
                    }
            }
        if($yra != NULL)
        {
        ?>
        <div class="container">
        <h2>Siūlome</h2>
        <div class="row">
        <?php
            $rez = 0;
            $q = "SELECT items_kategorija_id FROM uzsakymas_atliktas WHERE login_vardas='$name'";
            if ($result = $conn->query($q)) 
            {
                while ($row = $result->fetch_assoc()) 
                    {
                        $rez = $row['items_kategorija_id']; 
                    }
            }
            
            $query = "SELECT * FROM produktas WHERE kat_id=$rez ORDER BY id ASC ";
            $result = mysqli_query($conn,$query);
                    while ($row = $result->fetch_assoc()):
        ?>
                <div class="col-md-3">
                    <div class="product">
                        <form method="post" action="shop-produktai.php?action=add&id=<?php echo $row["id"]; ?>">

                            <img src="img/<?php echo $row["image"]; ?>" class="img-responsive" style="width: 100%">
                                <h5 class="text-info"><?php echo $row["pname"]; ?></h5>
                                <h5 class="text-danger"><?php echo $row["price"]; ?> €</h5>
                                <input type="text" name="quantity" class="form-control" value="1">
                                <input type="hidden" name="hidden_name" value="<?php echo $row["pname"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                                <input type="hidden" name="hidden_kiekis" value="<?php echo $row["kiekis"]; ?>">
                                <input type="hidden" name="hidden_kategorija" value="<?php echo $row["kat_id"]; ?>">
                                <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success"
                                       value="Į krepšelį">
                                </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
</div>
    <?php }} ?>
  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

<?php
    require "footer.php";
?>