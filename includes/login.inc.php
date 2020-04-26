<html>
<body>
    
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>

<?php

if(isset($_POST['login-submit']))
{
    
    require 'dbh.inc.php';
    
    $emailvardas = $_POST['mailuid'];
    $pass = $_POST['pwd'];
    
    if(empty($emailvardas) || empty($pass)) //tikrina ar laukai netusti
    {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else
    {
        $sql = "SELECT * FROM vartotojas WHERE vardas=? OR elpastas=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) //tikrina ar prisijunge prie duombazes
        {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "ss", $emailvardas, $emailvardas);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)) //tikrina ar yra toks vartotojas
            {
                $hash = $row['password'];
                $pwdCheck = password_verify($pass, $hash);
                if($pwdCheck == false) //tikrina ar vienodi slaptazodziai
                {
                    
                           ?>
                                <script> 
                                        Swal.fire({
                                                icon: 'error',
                                                text: 'Neteisingas slaptažodis!'
                                                }).then(function() {
                                                window.location="../index.php";
                                            });
                                </script>
                            <?php
                    exit();
                }
                else if($pwdCheck == true)
                {
                    session_start();
                    $_SESSION['userID'] = $row['id'];
                    $_SESSION['userName'] = $row['vardas'];
                    $_SESSION['userEmail'] = $row['elpastas'];
                    $_SESSION['userRole'] = $row['role'];          
                    
                            ?>
                                <script> 
                                        Swal.fire({
                                                icon: 'success',
                                                text: 'Sėkmingai prisijungėte!',
                                                timer: 1500
                                                }).then(function() {
                                                window.location="../index.php";
                                            });
                                </script>
                            <?php
                    exit();
                }
                else
                {
                            ?>
                                <script> 
                                        Swal.fire({
                                                icon: 'error',
                                                text: 'Neteisingas slaptažodis!'
                                                }).then(function() {
                                                window.location="../index.php";
                                            });
                                </script>
                            <?php
                    exit();
                }
            }
            else
            {
                header("Location: ../index.php?error=nouser");
                exit();
            }
            
        }
    }
    
}
else
{
    header("Location: ../index.php");
    exit();
}

?>
</body>
</html>