<?php
$servername = "localhost";
$username = "root";
$serverpassword = "";
$dbname = "eventos_tech";

$connection = mysqli_connect($servername, $username, $serverpassword, $dbname);

if (!$connection) {
    die("Error de conexión: " . mysqli_connect_error());
}
