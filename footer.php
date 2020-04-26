<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
    <style>

        .mano{
            margin-top: 15px;
            margin-bottom: 5px;
        }
        
    </style>
  </head>
    
<body class="d-flex flex-column">
  <div id="page-content">
    <div class="container text-center">
      <div class="row justify-content-center">
        <div class="col">
          <h1 class="font-weight-light mt-4 text-white">h</h1>
          <p class="lead text-white-50"></p>
        </div>
      </div>
    </div>
  </div>
  <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
      <div class="container">
        <div class="row">
          <div class="col">
              <p class="lead"> Vartotojų nuorodos </p>
              <?php 
                
                $mysqli = new mysqli('localhost', 'root', '', 'projektas') or die(mysqli_error($mysqli));
                $result = $mysqli->query("SELECT * FROM nuoroda ORDER BY RAND() LIMIT 2") or die($mysqli->error);
                while ($row = $result->fetch_assoc()):
                    echo $row['u_vardas']; ?> - <?php echo $row['zinute']; ?> <br> <?php
                endwhile;
                ?>
          </div>
          
          <div class="col">
              <p class="lead"> Dar kasnors </p>
              KTU fakultetas: Informatikos <br>
              Grupė: IFZK-7
          </div>
          
          
        </div>
      </div>
    <div class="container text-center">
        <div class="mano">
            <small>Copyright &copy; Ridearnas.lt</small>
        </div>
    </div>
  </footer>
</body>
</html>