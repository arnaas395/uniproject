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
        
        .h2{
            text-align: center;
            color: #212529;
            background-color: #efefef;
            padding: 2%;
        }
        
        
    </style>
  </head>
    
    <body>
    <h2 class="h2"> Vartotojų Įrašai </h2>
        <div class="container">
        
        <?php 
            include('functions.php');
            
            $mysqli = new mysqli('localhost', 'root', '', 'projektas') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM nuoroda") or die($mysqli->error);
            
        ?>
            
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Prisijungimo vardas</th>
                        <th>El.paštas</th>
                        <th>Žinute</th>
                    </tr>
                </thead>
                <?php
                    while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td> <?php echo $row['u_vardas'];?> </td>
                    <td> <?php echo $row['u_epastas'];?> </td>
                    <?php
                        if(isAdmin())
                        {
                            ?> <td> <a href="<?php echo $row['zinute']?>"><?php echo $row['zinute']?></a></td> <?php
                        }
                        else 
                        {
                            ?> <td> <?php echo $row['zinute']?> </td> <?php
                        }
                    ?>
                    <td> 
                    </td>
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
