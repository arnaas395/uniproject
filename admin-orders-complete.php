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
    <h2> Atlikti užsakymai</h2>
        <div class="container">
        
        <?php 
                
            $mysqli = new mysqli('localhost', 'root', '', 'projektas') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM uzsakymas_atliktas") or die($mysqli->error);
            
        ?>
            
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nr.</th>
                        <th>Prisijungimo vardas </th>
                        <th>Užsakymo id</th>
                        <th>Užsakymo kaina</th>
                        <th>Prekės</th>
                    </tr>
                </thead>
                <?php
                    while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td> <?php echo $row['id'];?> </td>
                    <td> <?php echo $row['login_vardas'];?> </td>
                    <td> <?php echo $row['uzsakymo_id'];?> </td>
                    <td> <?php echo number_format($row['kaina'],2);?> €</td>
                    <td> <?php echo $row['items']; ?> </td>
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