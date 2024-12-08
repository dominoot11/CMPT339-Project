<?php
$host = "localhost";          // MAMP uses localhost
$port = 8889;                 // Default MAMP MySQL port
$username = "root";           // Default username for MAMP
$password = "root";           // Default password for MAMP
$database = "tradesflow";

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
