<?php
    
    require 'header.php';
    require 'includes/dbh.inc.php';
    
    
    
    if (isset($_POST["add"])){
        if (isset($_SESSION["shop-produktai"]))
            {
                $item_array_id = array_column($_SESSION["shop-produktai"],"product_id");
                if (!in_array($_GET["id"],$item_array_id)){
                    $count = count($_SESSION["shop-produktai"]);
                    $item_array = array(
                        'product_id' => $_GET["id"],
                        'item_name' => $_POST["hidden_name"],
                        'product_price' => $_POST["hidden_price"],
                        'item_quantity' => $_POST["quantity"],
                    );
                    if($_POST["hidden_kiekis"] > 0)
                    {
                        if($_POST["quantity"] <= $_POST["hidden_kiekis"])
                        {
                            $_SESSION["shop-produktai"][$count] = $item_array;
                        }
                        else
                        {
                            echo '<script>alert("Nepakankamas prekiu likutis - perdaug")</script>';
                            echo '<script>window.location="shop-produktai.php"</script>';
                        }
                    }
                    else
                    {
                        echo '<script>alert("Nepakankamas prekiu likutis - nebeturime")</script>';
                        echo '<script>window.location="shop-produktai.php"</script>';
                    }
                    
            }   
            else
            {
                echo '<script>alert("Product is already Added to Cart")</script>';
                echo '<script>window.location="shop-produktai.php"</script>';
            }
        }
        else
        {
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["shop-produktai"][0] = $item_array;
        }
      }
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Striukės</title>

 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <style>

        .product{
            border: 1px solid #eaeaec;
            margin: -1px 19px 3px -1px;
            padding: 10px;
            text-align: center;
            background-color: #efefef;
        }
        table, th, tr{
            text-align: center;
        }
        .title2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        h2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        table th{
            background-color: #efefef;
        }
    </style>
</head>
<body>

        <h2>Striukės</h2>
        <div class="container" style="width: 65%">
            <div class="row">
        <?php
            $query = "SELECT * FROM produktas WHERE kat_id=4 ORDER BY id ASC";
            $result = mysqli_query($conn,$query);
                    while ($row = $result->fetch_assoc()):
                ?>
                <div class="col-md-3">
                    <div class="product">
                        <form method="post" action="shop-snieglentes.php?action=add&id=<?php echo $row["id"]; ?>">

                                <img src="<?php echo $row["image"]; ?>" class="img-responsive" style="width: 100%">
                                <h5 class="text-info"><?php echo $row["pname"]; ?></h5>
                                <h5 class="text-danger"><?php echo $row["price"]; ?> €</h5>
                                <input type="text" name="quantity" class="form-control" value="1">
                                <input type="hidden" name="hidden_name" value="<?php echo $row["pname"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                                <input type="hidden" name="hidden_kiekis" value="<?php echo $row["kiekis"]; ?>">
                                <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success"
                                       value="Į krepšelį">
                                </form>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
    </div>

</body>
</html>

<?php
    require 'footer.php';
?>