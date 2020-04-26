<html>
<body>
    
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>


<?php


if(isset($_POST['signup-submit']))
{
    require 'dbh.inc.php'; //atidaro duombaze
    
    $vardas = $_POST['uname'];
    $epastas = $_POST['email'];
    $slaptazodis = $_POST['pwd'];
    $slaptazodisPakartot = $_POST['pwd-repeat'];
    
    if(empty($vardas) || empty($epastas) || empty($slaptazodis) || empty($slaptazodisPakartot)) //tikrina ar laukai netusti
    {
        
        header("Location: ../signup.php?error=emptyfields&vardas=".$vardas."&epastas=".$epastas);
        exit();
        
    }
    elseif (!filter_var($epastas,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$vardas)) //tikrina abu
    {
        header("Location: ../signup.php?error=invalidmailname");
        exit();
    }
    elseif (!filter_var($epastas,FILTER_VALIDATE_EMAIL)) //tikrina email
    {
        header("Location: ../signup.php?error=invalidmail&vardas=".$vardas);
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/",$vardas)) //tikrina username
    {
        header("Location: ../signup.php?error=invaliname&epastas=".$epastas);
        exit();
    }
    elseif ($slaptazodis !== $slaptazodisPakartot) //tikrina ar sutampa slaptazodziai
    {
        header("Location: ../signup.php?error=passwordcheck&name=".$vardas."&epastas".$epastas);
        exit();
    }
    else //tikrina ar nera tokio vardo duombazej
    {
        $sql = "SELECT vardas FROM vartotojas WHERE vardas=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $vardas);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt); //grazina 0 ar 1, jei 1 tai yra toks
            if ($resultCheck > 0)
            {
                header("Location: ../signup.php?error=usertaken&epastas=".$epastas);
                exit();
            }
            else
            {
                $sql = "INSERT INTO vartotojas (vardas, elpastas, role, password) VALUES (?, ?, ?, ?) "; // klaustukai kad butu safe
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql))
                {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else
                {
                    $hashedPwd = password_hash($slaptazodis, PASSWORD_DEFAULT); //paslepia slaptazodi
                    $role = "vartotojas";
                    
                    mysqli_stmt_bind_param($stmt, "ssss", $vardas, $epastas, $role, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                            ?>
                                <script> 
                                        Swal.fire({
                                                icon: 'success',
                                                text: 'Sėkmingai prisiregistravote!'
                                                }).then(function() {
                                                window.location="../index.php";
                                            });
                                </script>
                            <?php
                    exit();
                }
            }
        }
        
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
}

else 
{
    header("Location: ../signup.php");
    exit();
}

?>
</body>
</html>
