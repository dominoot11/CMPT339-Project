<?php
$host = "localhost"; // or 127.0.0.1
$username = "root"; // or another username
$password = ""; // empty if default
$database = "crew_management";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!";
?>
