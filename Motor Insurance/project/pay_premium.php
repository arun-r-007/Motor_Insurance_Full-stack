<?php
$servername = "localhost";
$username = "root";
$password = "XXXXX";
$dbname = "customer";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
$vehicle_num = $_POST['vehicleNumber'];
$amount = $_POST['amount'];

$sql = "INSERT INTO payment_details (name, vehicle_num, amount, payment_date) VALUES ('$name', '$vehicle_num', '$amount', CURDATE())";



    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>