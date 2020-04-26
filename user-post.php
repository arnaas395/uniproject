<?php

    require 'header.php';

?>


<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

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
    <h2>Įkelkite įdomią nuorodą</h2> 
    <div class="container" style="width: 100%">
    <form action="includes/post.inc.php" method="post" class="form-horizontal">

    <div class="form-group">
        <input type="text" class="form-control" name="post-text" required>
    </div>
         <center> <button type="submit" name="post-submit" class="btn btn-primary"> Siųsti </button> </center>
    </form>

    </div>


</body>
</html>

<?php
    require 'footer.php';
?>