<?php
// insert_data.php

include "db_conn.php";

// Check if the required parameters are set
if (isset($_POST['name']) && isset($_POST['vehicle_num']) && isset($_POST['date']) && isset($_POST['request'])) {
    $name = $_POST['name'];
    $vehicle_num = $_POST['vehicle_num'];
    $date = $_POST['date'];
    $request = 'YES';

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO request_claim (cname, vehicle_num, date_time, request) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $name, $vehicle_num, $date, $request);

    if ($stmt->execute()) {
        echo 'Success';
    } else {
        echo 'Error: ' . $stmt->error;
    }

    $stmt->close();
} else {
    echo 'Error: Missing parameters';
}

$conn->close();
?>
