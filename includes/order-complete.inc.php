<html>
<body>
    
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>

<?php

if(isset($_POST['order-admin-submit']))
{
        require 'dbh.inc.php';
    
        $uzsakymo_id = $_POST['uzsakymo_id'];
        $items = $_POST['items'];
        $kaina = $_POST['kaina'];
        $vardas = $_POST['login_vardas'];
        $kat_id = $_POST['kategorijos_id'];
    
        $conn ->query("INSERT INTO uzsakymas_atliktas (login_vardas, uzsakymo_id, kaina, items, items_kategorija_id) VALUES ('$vardas', '$uzsakymo_id', '$kaina', '$items', '$kat_id')")
         or die($conn ->error);
        
        $sql = "DELETE FROM uzsakymas WHERE id=$uzsakymo_id";
        mysqli_query($conn, $sql);
        
                            ?>
                                <script> 
                                        Swal.fire({
                                                icon: 'success',
                                                text: 'Užsakymas atliktas',
                                                timer: 1500
                                                }).then(function() {
                                                window.location="../admin-orders.php";
                                            });
                                </script>
                            <?php
}

if(isset($_POST['order-admin-cancel']))
{
        require 'dbh.inc.php';

        $uzsakymo_id = $_POST['uzsakymo_id'];
        
        $sql = "DELETE FROM uzsakymas WHERE id=$uzsakymo_id";
        mysqli_query($conn, $sql);
        
                            ?>
                                <script> 
                                        Swal.fire({
                                                icon: 'success',
                                                text: 'Užsakymas ištrintas',
                                                timer: 1500
                                                }).then(function() {
                                                window.location="../admin-orders.php";
                                            });
                                </script>
                            <?php
}

?>

</body>
</html>