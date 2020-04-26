<html>
<body>
    
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>

<?php

if(isset($_POST['post-submit']))
{
        require 'dbh.inc.php';
        
        session_start();
        $vardas = $_SESSION['userName'];
        $elpastas = $_SESSION['userEmail'];
        $zinute = $_POST['post-text'];
    
        $conn ->query("INSERT INTO nuoroda_tarpine (u_vardas, u_epastas, zinute) VALUES ('$vardas', '$elpastas', '$zinute')")
         or die($conn ->error);
    
                            ?>
                                <script> 
                                        Swal.fire({
                                                icon: 'success',
                                                title: 'Nuoroda nusiųsta!',
                                                text: 'Prašome palaukti administratoriaus patvirtinimo.'
                                                }).then(function() {
                                                window.location="../user.php";
                                            });
                                </script>
                            <?php
}

?>

</body>
</html>