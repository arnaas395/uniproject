<html>
<body>
    
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>

<?php

if(isset($_POST['post-admin-submit']))
{
        require 'dbh.inc.php';
        
        session_start();
        $vardas = $_POST['vardas'];
        $elpastas = $_POST['elpastas'];
        $zinute = $_POST['zinute'];
        $id = $_POST['id'];
    
        $conn ->query("INSERT INTO nuoroda (u_vardas, u_epastas, zinute) VALUES ('$vardas', '$elpastas', '$zinute')")
         or die($conn ->error);
        
        $sql = "DELETE FROM nuoroda_tarpine WHERE id=$id";
        mysqli_query($conn, $sql);
        
                            ?>
                                <script> 
                                        Swal.fire({
                                                icon: 'success',
                                                title: 'Nuoroda paskelbta!',
                                                timer: 1500
                                                }).then(function() {
                                                window.location="../admin-post.php";
                                            });
                                </script>
                            <?php
}

if(isset($_POST['post-admin-cancel']))
{
        require 'dbh.inc.php';
        $id = $_POST['id'];
        
        $sql = "DELETE FROM nuoroda_tarpine WHERE id=$id";
        mysqli_query($conn, $sql);
        
                            ?>
                                <script> 
                                        Swal.fire({
                                                icon: 'error',
                                                title: 'Nuoroda atmesta!',
                                                timer: 1500
                                                }).then(function() {
                                                window.location="../admin-post.php";
                                            });
                                </script>
                            <?php
}

?>

</body>
</html>