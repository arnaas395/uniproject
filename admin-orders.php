<?php 

    require 'header.php';

    include('functions.php');

if (!isLoggedIn()) 
{
	echo '<script>alert("Turite prisijungti!")</script>';
	header('location: index.php');
}
if(!isAdmin())
{
    	echo '<script>alert("Turite prisijungti!")</script>';
	header('location: index.php');
}

?>

<html>
 <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title></title>
    
    <style>
        
        h2{
            text-align: center;
            color: #212529;
            background-color: #efefef;
            padding: 2%;
        }
        
    </style>
  </head>
    
    <body>
    <h2> Užsakymai </h2>
        <div class="container">
        
        <?php 
                
            $mysqli = new mysqli('localhost', 'root', '', 'projektas') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM uzsakymas") or die($mysqli->error);
            
        ?>
            
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nr.</th>
                        <th>Prisijungimo vardas</th>
                        <th>Užsakymo kaina</th>
                        <th>Valstybė, miestas</th>
                        <th>Gatvė, pašto kodas</th>
                        <th>Prekės</th>
                    </tr>
                </thead>
                <?php
                    while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td> <?php echo $row['id'];?> </td>
                    <td> <?php echo $row['login_vardas'];?> </td>
                    <td> <?php echo number_format($row['kaina'],2);?> €</td>
                    <td> <?php echo $row['valstybe'];?> , <?php echo $row['miestas']?> </td>
                    <td> <?php echo $row['gatve']; ?> , LT-<?php echo $row['pasto_kodas']?> </td>
                    <td> <?php echo $row['items']; ?> </td>
                <form method="post" action="includes/order-complete.inc.php" class="form-horizontal">        
                    <input type="hidden" name="uzsakymo_id" value="<?php echo $row['id'];?>" >
                    <input type="hidden" name="kategorijos_id" value="<?php echo $row['items_kategorija_id'];?>" >
                    <input type="hidden" name="login_vardas" value="<?php echo $row['login_vardas'];?>" >
                    <input type="hidden" name="kaina" value="<?php echo $row['kaina'];?>" >
                    <input type="hidden" name="items" value="<?php echo $row['items']; ?>" >
                    <td>    <button type="submit" name="order-admin-submit" class="btn btn-success"> Atlikti </button> </td>
                    <td>    <button type="submit" name="order-admin-cancel" class="btn btn-danger"> Atmesti </button> </td>
                        
                </form>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        </div>
    </body>
</html>

<?php 

    require 'footer.php';

?>