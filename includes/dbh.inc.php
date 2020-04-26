<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "projektas";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if (!$conn)
{
    die("Nepavyko prisijungti: ".mysqli_connect_error());
}
