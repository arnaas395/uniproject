<?php

if(isset($_POST['user-delete']))
{
    
        require 'dbh.inc.php';

        $vard = $_POST['vardas'];
        
        $sql = "DELETE FROM vartotojas WHERE vardas='$vard'";
        mysqli_query($conn, $sql);
        
        $sql = "DELETE FROM nuoroda WHERE u_vardas='$vard'";
        mysqli_query($conn, $sql);
        
        $sql = "DELETE FROM uzsakymas_atliktas WHERE login_vardas='$vard'";
        mysqli_query($conn, $sql);
        
        echo '<script>alert("Vartotojas ištrintas!")</script>';
        echo '<script>window.location="../admin-users.php"</script>';
        
    
}

