<?php
    
    require 'header.php';
    require 'includes/dbh.inc.php';
    
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parduotuvė</title>

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
            color: #212529;
            background-color: #efefef;
            padding: 2%;
        }
        table th{
            background-color: #efefef;
        }
    </style>
</head>
<body>

        <h2>Parduotuvė</h2>
        <div class="container">
        <?php
        
            if(!empty($_SESSION["shop-produktai"]))
            {
                echo '
                    <div class="row">
                    <div class="col">
                    <h3 class="title2">Pasirinktų prekių sąrašas</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th width="30%">Produktas</th>
                <th width="10%">Kiekis</th>
                <th width="13%">Kaina</th>
                <th width="10%"></th>
                <th width="17%">Pašalinti prekę</th>
            </tr>';

                
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
                            <td><a href="shop-produktai.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span
                                        class="text-danger">Pašalinti prekę</span></a></td>

                        </tr>
                        <tr>
                        <?php
                        $total = $total + ($value["item_quantity"] * $value["product_price"]);
                        
                    }
                    
                        if($total > 500 && $total < 1000)
                        {
                            $total = $total / 1.05;
                            echo '<td colspan="2" align="right">Jums pritaikyta 5% nuolaida</td>                             
                            <td align="right"> Iš viso:</td>';
                            
                            echo'<th align="right">€'; echo number_format($total, 2); echo'</th>';
                        }
                        else if ($total > 1000 && $total < 2000)
                        {
                            $total = $total / 1.07;
                            echo '<td colspan="2" align="right">Jums pritaikyta 7% nuolaida</td>                             
                            <td align="right"> Iš viso:</td>';
                            
                            echo'<th align="right">€'; echo number_format($total, 2); echo'</th>';
                        }
                        else if ($total > 2000)
                        {
                            $total = $total / 1.14;
                            echo '<td colspan="2" align="right">Jums pritaikyta 14% nuolaida</td>                             
                            <td align="right"> Iš viso:</td>';
                            
                            echo'<th align="right">€'; echo number_format($total, 2); echo'</th>';
                        }
                        else
                        {                         
                            echo '<td colspan="3" align="right"> Iš viso:</td>';
                            
                            echo'<th align="right">€'; echo number_format($total, 2); echo'</th>';
                        }
                        
                        }
                        ?>
                            <td>
                                <a href="http://localhost/projektas/shop-cart.php" class="btn btn-dark btn-sm"> Užsakyti </a>
                            </td>
                        </tr>
            </table>
        <?php
        echo '</div>'
        . '</div>';
            }
        ?>
        
        
            
            <?php       
                    $sniegmoney = 0;
                    $batmoney = 0;
                    $pirstmoney = 0;
                    $striukmoney = 0;
                    $query = "SELECT pavadinimas, kaina, login_vardas FROM produkto_kategorijos LEFT JOIN uzsakymas_atliktas ON produkto_kategorijos.id = uzsakymas_atliktas.items_kategorija_id";
                    $result = mysqli_query($conn,$query);
                    while ($row = $result->fetch_assoc()):
                        
                        $pav = $row["pavadinimas"];
                    
                    if(isset($_SESSION['userName']))
                    {
                        if($_SESSION['userName'] == $row["login_vardas"])
                        {
                            if($pav == 'Snieglentes')
                            {
                                $sniegmoney = $sniegmoney + $row["kaina"];
                            }
                            else if ($pav == 'Batai')
                            {
                                $batmoney = $batmoney + $row["kaina"];
                            }
                            else if ($pav == 'Pirstines')
                            {
                                $pirstmoney = $pirstmoney + $row["kaina"];
                            }
                            else if ($pav == 'Striukes')
                            {
                                $striukmoney =  $striukmoney + $row["kaina"];
                            }
                        }
                    }
                        
                        endwhile; 
            ?>
        <div class="row">
        <?php
            $query = "SELECT * FROM produktas ORDER BY id ASC ";
            $result = mysqli_query($conn,$query);
                    while ($row = $result->fetch_assoc()):
                ?>
                <div class="col-3">
                    <div class="product">
                        <form method="post" action="shop-produktai.php?action=add&id=<?php echo $row["id"]; ?>">

                            <img src="img/<?php echo $row["image"]; ?>" class="img-responsive" style="width: 100%">
                                <h5 class="text-info"><?php echo $row["pname"]; ?></h5>
                                
                                <?php
                                    $gkaina = 0;
                                    $akcija = 0;
                                    if($row["kat_id"] == 1)
                                    {
                                        if($sniegmoney > 1000)
                                        {
                                            $akcija = $row["price"] / 1.1;
                                            $akcija = number_format($akcija, 2);
                                            $gkaina = $akcija;
                                            ?> 
                                                <strike> <h5 class="text-danger"><?php echo $row["price"]; ?> €</h5> </strike>
                                                <h5 class="text-success"> <?php echo $akcija; ?> €</h5> 
                                            <?php
                                        }
                                        else 
                                        {
                                            $gkaina = $row["price"];
                                            ?> <h5 class="text-danger"><?php echo $row["price"]; ?> €</h5> <?php
                                        }
                                    }
                                    else if($row["kat_id"] == 2)
                                    {
                                        if($batmoney > 1000)
                                        {
                                            $akcija = $row["price"] / 1.1;
                                            $akcija = number_format($akcija, 2);
                                            $gkaina = $akcija;
                                            ?> 
                                                <strike> <h5 class="text-danger"><?php echo $row["price"]; ?> €</h5> </strike>
                                                <h5 class="text-success"><?php echo $akcija; ?> €</h5> 
                                            <?php
                                        }
                                        else 
                                        {
                                            $gkaina = $row["price"];
                                            ?> <h5 class="text-danger"><?php echo $row["price"]; ?> €</h5> <?php
                                        }
                                    }
                                    else if($row["kat_id"] == 3)
                                    {
                                        if($pirstmoney > 1000)
                                        {
                                            $akcija = $row["price"] / 1.1;
                                            $akcija = number_format($akcija, 2);
                                            $gkaina = $akcija;
                                            ?> 
                                            <strike> <h5 class="text-danger"><?php echo $row["price"]; ?> €</h5> </strike>
                                            <h5 class="text-success"><?php echo $akcija; ?> €</h5> 
                                            <?php
                                        }
                                        else 
                                        {
                                            $gkaina = $row["price"];
                                            ?> <h5 class="text-danger"><?php echo $row["price"]; ?> €</h5> <?php
                                        }
                                    }
                                    else if($row["kat_id"] == 4)
                                    {
                                        if($striukmoney > 1000)
                                        {
                                            $akcija = $row["price"] / 1.1;
                                            $akcija = number_format($akcija, 2);
                                            $gkaina = $akcija;
                                            ?> 
                                            <strike> <h5 class="text-danger"><?php echo $row["price"]; ?> €</h5> </strike>
                                            <h5 class="text-success"><?php echo $akcija; ?> €</h5> 
                                            <?php
                                        }
                                        else 
                                        {
                                            $gkaina = $row["price"];
                                            ?> <h5 class="text-danger"><?php echo $row["price"]; ?> €</h5> <?php
                                        }
                                    }
                                ?>
                                <input type="text" name="quantity" class="form-control" value="1">
                                <input type="hidden" name="hidden_name" value="<?php echo $row["pname"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $gkaina; ?>">
                                <input type="hidden" name="hidden_kiekis" value="<?php echo $row["kiekis"]; ?>">
                                <input type="hidden" name="hidden_kategorija" value="<?php echo $row["kat_id"]; ?>">
                                <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success"
                                       value="Į krepšelį">
                                </form>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
<?php

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
                        'item_category' => $_POST["hidden_kategorija"],
                    );
                    if($_POST["hidden_kiekis"] > 0)
                    {
                        if($_POST["quantity"] <= $_POST["hidden_kiekis"])
                        {
                            $_SESSION["shop-produktai"][$count] = $item_array;
                            
                            ?>
                                <script> 
                                        Swal.fire({
                                                icon: 'success',
                                                text: 'Produktas pridėtas į krepšelį',
                                                timer: 1500
                                                }).then(function() {
                                                window.location="shop-produktai.php";
                                            });
                                </script>
                            <?php
                            
                        }
                        else
                        {
                            ?>
                                <script> 
                                        Swal.fire({
                                                icon: 'error',
                                                text: 'Nepakankamas prekiu likutis - perdaug'
                                                }).then(function() {
                                                window.location="shop-produktai.php";
                                            });
                                </script>
                            <?php
                        }
                    }
                    else
                    {
                            ?>
                                <script> 
                                        Swal.fire({
                                                icon: 'error',
                                                text: 'Nepakankamas prekiu likutis - nebeturime'
                                                }).then(function() {
                                                window.location="shop-produktai.php";
                                            });
                                </script>
                            <?php
                    }
                    
            }   
            else
            {
                            ?>
                                <script> 
                                        Swal.fire({
                                                icon: 'error',
                                                text: 'Produktas jau pridėtas',
                                                timer: 1500
                                                }).then(function() {
                                                window.location="shop-produktai.php";
                                            });
                                </script>
                            <?php
            }
        }
        else
        {
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
                'item_category' => $_POST["hidden_kategorija"],
            );
            $_SESSION["shop-produktai"][0] = $item_array;
            ?>
                                <script> 
                                        Swal.fire({
                                                icon: 'success',
                                                text: 'Produktas pridėtas į krepšelį',
                                                timer: 1500
                                                }).then(function() {
                                                window.location="shop-produktai.php";
                                            });
                                </script>
            <?php
        }
      }

?>
                                
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
                                                window.location="shop-produktai.php";
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