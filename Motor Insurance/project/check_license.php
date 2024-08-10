<?php
// check_license.php

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "XXXXX";
$dbname = "customer"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the license number from the AJAX request
$licenseNumber = $_POST['licenseNumber'];

// Prepare and execute the SQL query
$sql = "SELECT COUNT(*) as count FROM customer WHERE clicense = ?"; // Replace with your table name and column name
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $licenseNumber);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Return JSON response
$response = array('exists' => $row['count'] > 0);
echo json_encode($response);

// Close the connection
$stmt->close();
$conn->close();
?>
