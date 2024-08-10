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

    $stmt = $conn->prepare("INSERT INTO credit_card_details(card_name ,vehicle_num,price, card_number, expiry_date, cvv,date_time) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $card_name,$vehicle_num,$price, $card_number, $expiry_date, $cvv,$currentDateTime);

    if ($stmt->execute()) {
        echo "Payment details saved successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>