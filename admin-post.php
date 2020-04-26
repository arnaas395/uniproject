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
    <h2> Vartotojų įrašai </h2>
        <div class="container">
        
        <?php 
                
            $mysqli = new mysqli('localhost', 'root', '', 'projektas') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM nuoroda_tarpine") or die($mysqli->error);
            
        ?>
            
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nr.</th>
                        <th>Prisijungimo vardas</th>
                        <th>El.paštas</th>
                        <th>Žinute</th>
                    </tr>
                </thead>
                <?php
                    while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td> <?php echo $row['id'];?> </td>
                    <td> <?php echo $row['u_vardas'];?> </td>
                    <td> <?php echo $row['u_epastas'];?> </td>
                    <td> <a href="<?php echo $row['zinute']?>"><?php echo $row['zinute']?></a></td>
                <form method="post" action="includes/post.post.inc.php" class="form-horizontal">        
                    <input type="hidden" name="id" value="<?php echo $row['id'];?>" >
                    <input type="hidden" name="vardas" value="<?php echo $row['u_vardas'];?>" >
                    <input type="hidden" name="elpastas" value="<?php echo $row['u_epastas'];?>" >
                    <input type="hidden" name="zinute" value="<?php echo $row['zinute']?>" >
                    <td> <button type="submit" name="post-admin-submit" class="btn btn-success"> Paskelbti </button> </td>
                    <td> <button type="submit" name="post-admin-cancel" class="btn btn-danger"> Atmesti </button> </td>
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
