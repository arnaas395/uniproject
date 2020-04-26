<?php

    require 'header.php';
    require 'includes/dbh.inc.php';

?>


<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Krepšelis</title>

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
            color: #212529;
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

    <div class="container mt-4" style="width: 65%">
        <div style="clear: both"></div>
        <h3 class="title2">Krepšelis</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th width="30%">Produktas</th>
                <th width="10%">Kiekis</th>
                <th width="13%">Kaina</th>
                <th width="10%"></th>
                <th width="17%">Pašalinti prekę</th>
            </tr>

            <?php
                
                $items = '';
                $category_id = 0;
                
                if(!empty($_SESSION["shop-produktai"])){
                    $total = 0;
                    foreach ($_SESSION["shop-produktai"] as $key => $value) {
                        $category_id = $value["item_category"];
                        $items = $items.$value["item_name"].' x'.$value["item_quantity"].' | ';
                        ?>
                        <tr>
                            <td><?php echo $value["item_name"]; ?></td>
                            <td><?php echo $value["item_quantity"]; ?></td>
                            <td>€ <?php echo $value["product_price"]; ?></td>
                            <td>
                                € <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>
                            <td><a href="shop-cart.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span
                                        class="text-danger">Pašalinti prekę</span></a></td>

                        </tr>
                        <tr>
                        <?php
                        
                        $total = $total + ($value["item_quantity"] * $value["product_price"]);
                        $totalbe = $total;
                        
                    }
                    
                        if($total > 500 && $total < 1000)
                        {
                            $total = $total / 1.05;
                            echo '<td colspan="1" align="right">Jums pritaikyta 5% nuolaida</td>                             
                            <td align="right"> Iš viso:</td>';
                            
                            echo'<th align="right">€'; echo number_format($total, 2); echo'</th>';
                            echo'<th align="right">€'; echo number_format($totalbe, 2); echo'</th>';
                        }
                        else if ($total > 1000 && $total < 2000)
                        {
                            $total = $total / 1.07;
                            echo '<td colspan="1" align="right">Jums pritaikyta 7% nuolaida</td>                             
                            <td align="right"> Iš viso:</td>';
                            
                            echo'<th align="right">€'; echo number_format($total, 2); echo'</th>';
                            echo'<th align="right">€'; echo number_format($totalbe, 2); echo'</th>';
                        }
                        else if ($total > 2000)
                        {
                            $total = $total / 1.14;
                            echo '<td colspan="1" align="right">Jums pritaikyta 14% nuolaida</td>                             
                            <td align="right"> Iš viso:</td>';
                            
                            echo'<th align="right">€'; echo number_format($total, 2); echo'</th>';
                            echo'<th align="right">€'; echo number_format($totalbe, 2); echo'</th>';
                        }
                        else
                        {                         
                            echo '<td colspan="3" align="right"> Iš viso:</td>';
                            
                            echo'<th align="right">€'; echo number_format($totalbe, 2); echo'</th>';
                        }
                        
                        }
                        ?>
                            <td>
                            </td>
                        </tr>
            </table>
        </div>
    </div>
    
    <div class="container" style="width: 65%">
    <h3 class="title2">Pristatymo duomenys</h3>
    <form action="includes/order.inc.php" method="post" class="form-horizontal">
        <div class="form-group">
                    <label for="formGroupExampleInput">Valstybė</label>
                    <input type="text" class="form-control" name="check-state" required>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="formGroupExampleInput">Miestas</label>
                    <input type="text" class="form-control" name="check-city" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="formGroupExampleInput">Gatvė</label>
                    <input type="text" class="form-control" name="check-street" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="formGroupExampleInput">Pašto kodas</label>
                    <input type="text" class="form-control" name="check-postal" required>
                </div>
            </div>
            <input type="hidden" name="kaina" value="<?php echo $total; ?>" >
            <input type="hidden" name="items" value="<?php echo $items; ?>" >
            <input type="hidden" name="kategorijos_id" value="<?php echo $category_id; ?>" >
            <input type="hidden" name="session_name" value="<?php echo $_SESSION['userName']; ?>" >
        </div>
            <button type="submit" name="order-submit" class="btn btn-success">Užsakyti</button>
    </form>

    </div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>

    <?php
    
        if (isset($_GET["action"])){
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["shop-produktai"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["shop-produktai"][$keys]);
                            ?>
                                <script> 
                                        Swal.fire({
                                                icon: 'error',
                                                text: 'Produktas pašalintas!'
                                                }).then(function() {
                                                window.location="shop-cart.php";
                                            });
                                </script>
                            <?php
                }
            }
        }
    }
    
    ?>
</body>
</html>

<?php
    require 'footer.php';
?>