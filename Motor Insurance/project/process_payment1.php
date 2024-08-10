<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $card_name = $_POST['card_name'];
    $vehicle_num= $_POST['vehicle_num'];
    $price= $_POST['price'];
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];
    $currentDateTime = $_POST['current_date_time'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "XXXXX";
    $dbname = "customer";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert into credit_card_details_renew table
    $stmt1 = $conn->prepare("INSERT INTO credit_card_details_renew (card_name, vehicle_num, price, card_number, expiry_date, cvv, date_time) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt1->bind_param("sssssss", $card_name, $vehicle_num, $price, $card_number, $expiry_date, $cvv, $currentDateTime);

    // Insert into afteraddons table

  // Get today's date
  $todayDate = date('Y-m-d H:i:s');

  // Calculate the date one year from today
  $oneYearFromToday = date('Y-m-d H:i:s', strtotime('+1 year'));

  $stmt2 = $conn->prepare("UPDATE afteraddons SET date_added = ?, due_date = ? WHERE vehicle_num = ?");
  $stmt2->bind_param("sss", $todayDate, $oneYearFromToday, $vehicle_num);


  
    // Execute both statements
    if ($stmt1->execute() && $stmt2->execute()) {
        echo "Payment details and additional information saved successfully";
    } else {
        echo "Error: " . $stmt1->error . " " . $stmt2->error;
    }

    // Close statements and connection
    $stmt1->close();
    $stmt2->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
