<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "XXXXX";
$dbname = "customer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Get the input data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!isset($data['netPremium']) || !isset($data['vehicle_num']) || !isset($data['addons'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    exit();
}

$netPremium = $data['netPremium'];
$vehicle_num = $data['vehicle_num'];
$addons = json_encode($data['addons']); // Encode the addons array to JSON format



// Get the current date and time
$date_added = date('Y-m-d H:i:s');

// Create a DateTime object with the current date and time
$current_date_time = new DateTime($date_added);

// Add one year to the current date and time
$current_date_time->modify('+1 year');

// Format the date and time
$date_time_plus_one_year = $current_date_time->format('Y-m-d H:i:s');



// Prepare and bind
$stmt = $conn->prepare("INSERT INTO afteraddons (vehicle_num, netPremium, addons, date_added,due_date) VALUES (?, ?, ?, ?, ?)");
if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
    exit();
}

$stmt->bind_param("sdsss", $vehicle_num, $netPremium, $addons, $date_added,$date_time_plus_one_year);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Execute failed: ' . $stmt->error]);
}

// Close connections
$stmt->close();
$conn->close();
?>
