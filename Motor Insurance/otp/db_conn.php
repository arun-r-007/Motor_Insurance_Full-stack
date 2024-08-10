<?php  
$servername = "localhost";
$username = "root";
$password = "XXXXX";
$dbname = "customer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
