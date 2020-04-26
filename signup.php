<?php
    require "header.php";
?>

<head>
    <style>
        h2{
            text-align: center;
            color: #212529;
            background-color: #efefef;
            padding: 2%;
        }
    </style>
</head>
<main>
    <h2> Registracijos forma </h2>
    <div class="container">
    <div class="form-group">
        <?php
            
            if(isset($_GET['error']))
            {
                if($_GET['error'] =="emptyfields")
                {
                    echo '<p> Užpildykite visus laukelius </p>';
                }
            }
        
        ?>
    </div>
    <form action="includes/signup.inc.php" method="post" class="form-horizontal">
        <div class="form-group">
            <input class="form-control" type="text" name="uname" placeholder="Vartotojo vardas">
        </div>    
        <div class="form-group">    
            <input class="form-control" type="text" name="email" placeholder="El.paštas">
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="pwd" placeholder="Slaptažodis">
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="pwd-repeat" placeholder="Pakartoti slaptažodį">
        </div>
        <button class="btn btn-success" type="submit" name="signup-submit"> Registruotis </button>
    </form>
    </div>
</main>

<?php
    require "footer.php";
?>