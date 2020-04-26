<?php 

    require 'header.php';

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
    <h2> Mano atlikti užsakymai </h2>
        <div class="container">
        
        <?php 
                
            $mysqli = new mysqli('localhost', 'root', '', 'projektas') or die(mysqli_error($mysqli));
            $vard = $_SESSION['userName'];
            $result = $mysqli->query("SELECT * FROM uzsakymas_atliktas WHERE login_vardas='$vard'") or die($mysqli->error);
            
        ?>
            
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nr.</th>
                        <th>Užsakymo kaina</th>
                        <th>Prekės</th>
                    </tr>
                </thead>
                <?php
                    while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td> <?php echo $row['id'];?> </td>
                    <td> <?php echo number_format($row['kaina'],2);?> €</td>
                    <td> <?php echo $row['items']; ?> </td>
                <form method="post" action="includes/order-complete.inc.php" class="form-horizontal">        
                    <input type="hidden" name="uzsakymo_id" value="<?php echo $row['id'];?>" >
                    <input type="hidden" name="kategorijos_id" value="<?php echo $row['items_kategorija_id'];?>" >
                    <input type="hidden" name="kaina" value="<?php echo number_format($row['kaina'],2);?>" >
                    <input type="hidden" name="items" value="<?php echo $row['items']; ?>" >
                        
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

