<html>
<body>
    
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>

<?php

if(isset($_POST['order-submit']))
{   
    session_start();
    if(isset($_SESSION['userID']))
    {
        
        require 'dbh.inc.php';
    
        $valstybe = $_POST['check-state'];
        $vardas = $_POST['session_name'];
        $miestas = $_POST['check-city'];
        $gatve = $_POST['check-street'];
        $pasto = $_POST['check-postal'];
        $daiktai = $_POST['items'];
        $kaina = $_POST['kaina'];
        $kategorijos_id = $_POST['kategorijos_id'];
    
        $conn ->query("INSERT INTO uzsakymas (login_vardas, kaina, valstybe, miestas, gatve, pasto_kodas, items, items_kategorija_id) VALUES ('$vardas','$kaina', '$valstybe', '$miestas', '$gatve', '$pasto', '$daiktai', '$kategorijos_id')")
         or die($conn ->error);
        
                    foreach ($_SESSION["shop-produktai"] as $key => $value) {
                        
                        $rez = 0;
                        $id = $value["product_id"];
                        $kiekis = $value["item_quantity"];

                        $q = "SELECT kiekis FROM produktas WHERE id=$id";
                        if ($result = $conn->query($q)) {
                        while ($row = $result->fetch_assoc()) {
                        $rez = $row['kiekis']; 
                        }}
                        $rez = $rez - $kiekis;
                        
                        $sql = ("UPDATE produktas SET kiekis = $rez WHERE id = $id");
                        mysqli_query($conn, $sql);
                    }
        
                            ?>
                                <script> 
                                        Swal.fire({
                                                icon: 'success',
                                                text: 'Užsakymas priimtas!',
                                                timer: 1500
                                                }).then(function() {
                                                window.location="../shop-cart.php";
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
                                                text: 'Prisijunkite!'
                                                }).then(function() {
                                                window.location="../shop-cart.php";
                                            });
                                </script>
                            <?php
    }
}

?>
</body>
</html>