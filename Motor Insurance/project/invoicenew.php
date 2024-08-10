<?php
require 'vendor2/autoload.php'; // include the Composer autoload file

use Dompdf\Dompdf;

// Database connection details
$servername = "localhost";
$username = "root";
$password = "XXXXX";
$dbname = "customer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$currentDateTime = date('Y-m-d H:i:s');

// Retrieve the vehicle number from the URL
$vehicle_num = isset($_GET['vehicle_num']) ? $_GET['vehicle_num'] : '';

if ($vehicle_num) {
    // Fetch details from customer table using the vehicle number
    $sql_customer = "SELECT * FROM customer WHERE cemail = (SELECT cemail FROM curc WHERE vehicle_num = ?)";
    $stmt_customer = $conn->prepare($sql_customer);
    $stmt_customer->bind_param("s", $vehicle_num);
    $stmt_customer->execute();
    $result_customer = $stmt_customer->get_result();
    $customer_details = $result_customer->fetch_assoc();

    // Fetch details from rc table using the vehicle number
    $sql_rc = "SELECT * FROM rc WHERE vehicle_num = ?";
    $stmt_rc = $conn->prepare($sql_rc);
    $stmt_rc->bind_param("s", $vehicle_num);
    $stmt_rc->execute();
    $result_rc = $stmt_rc->get_result();
    $rc_details = $result_rc->fetch_assoc();

    // Fetch details from credit_card_details table using the vehicle number
    $sql_credit_card = "SELECT * FROM credit_card_details WHERE vehicle_num = ?";
    $stmt_credit_card = $conn->prepare($sql_credit_card);
    $stmt_credit_card->bind_param("s", $vehicle_num);
    $stmt_credit_card->execute();
    $result_credit_card = $stmt_credit_card->get_result();
    $credit_card_details = $result_credit_card->fetch_assoc();

    // Fetch details from afteraddons table using the vehicle number
    $sql_afteraddons = "SELECT * FROM afteraddons WHERE vehicle_num = ?";
    $stmt_afteraddons = $conn->prepare($sql_afteraddons);
    $stmt_afteraddons->bind_param("s", $vehicle_num);
    $stmt_afteraddons->execute();
    $result_afteraddons = $stmt_afteraddons->get_result();
    $afteraddons_details = $result_afteraddons->fetch_assoc();

    $imagePath = 'C:\xampp\htdocs\finall project\project\logo.png'; // Absolute path to your logo
    $imageData = base64_encode(file_get_contents($imagePath));
    $imageSrc = 'data:image/png;base64,' . $imageData;

    // Generate HTML content
    $html = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Invoice</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 20px; }
            .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); }
            .invoice-header { text-align: center; margin-bottom: 20px; }
            .invoice-header h1 { margin: 0; font-size: 2.5em; color: #333; }
            .invoice-header p { margin: 5px 0 0; font-size: 1.2em; color: #777; }
            .invoice-details { width: 100%; border-collapse: collapse; margin-top: 20px; }
            .invoice-details th, .invoice-details td { padding: 15px; border: 1px solid #ddd; text-align: left; }
            .invoice-details th { background-color: #f4f4f4; font-weight: bold; }
            .invoice-details tr:nth-child(even) { background-color: #f9f9f9; }
            .invoice-footer { margin-top: 20px; text-align: center; font-size: 1em; color: #777; }
        </style>
    </head>
    <body>
        <div class='invoice-box'>
            <div class='invoice-header'>
                <img src='$imageSrc' style='border-radius: 16%; position: absolute; top: 1%; left: 2%; height: 8%; width: 10.8%;' alt='Logo'>
               <h1 style='text-align: center;'>Motor Insurance</h1><br><br><br>
                <h1>Invoice Bill</h1><br><br>
                <p><b>Vehicle Number: " . htmlspecialchars($vehicle_num) . "<b></p><br><br>
            </div>
            <table class='invoice-details'>
                <br><br>";

    // Add customer details
    $html .= "<tr><th colspan='2'>Customer Details</th></tr><br><br>";
    $html .= "<tr>
                <td><b>Customer ID</b></td>
                <td>" . htmlspecialchars($customer_details['cid']) . "</td>
              </tr>
              <tr>
                <td><b>Name</b></td>
                <td>" . htmlspecialchars($customer_details['cname']) . "</td>
              </tr>
              <tr>
                <td><b>Date of Birth</b></td>
                <td>" . htmlspecialchars($customer_details['cdob']) . "</td>
              </tr>
              <tr>
                <td><b>Phone Number</b></td>
                <td>" . htmlspecialchars($customer_details['cphone_no']) . "</td>
              </tr>
              <tr>
                <td><b>Email</b></td>
                <td>" . htmlspecialchars($customer_details['cemail']) . "</td>
              </tr>
              <tr>
                <td><b>License Number</b></td>
                <td>" . htmlspecialchars($customer_details['clicense']) . "</td>
              </tr>
              <tr>
                <td><b>Address</b></td>
                <td>" . htmlspecialchars($customer_details['caddress']) . "</td>
              </tr>";

    // Add RC details
    $html .= "<br><br><br><br><br><br><br><br><tr><th colspan='2'>RC Details</th></tr><br><br>";
    $html .= "<tr>
                <td><b>Vehicle Number</b></td>
                <td>" . htmlspecialchars($rc_details['vehicle_num']) . "</td>
              </tr>
              <tr>
                <td><b>Registration Date</b></td>
                <td>" . htmlspecialchars($rc_details['registration_date']) . "</td>
              </tr>
              <tr>
                <td><b>Chassis Number</b></td>
                <td>" . htmlspecialchars($rc_details['chasi_number']) . "</td>
              </tr>
              <tr>
                <td><b>Engine Number</b></td>
                <td>" . htmlspecialchars($rc_details['engine_number']) . "</td>
              </tr>
              <tr>
                <td><b>Wheel Type</b></td>
                <td>" . htmlspecialchars($rc_details['wheel_type']) . "</td>
              </tr>
              <tr>
                <td><b>Fuel Type</b></td>
                <td>" . htmlspecialchars($rc_details['fuel_type']) . "</td>
              </tr>
              <tr>
                <td><b>Brand</b></td>
                <td>" . htmlspecialchars($rc_details['brand']) . "</td>
              </tr>
              <tr>
                <td><b>Model</b></td>
                <td>" . htmlspecialchars($rc_details['modell']) . "</td>
              </tr>
              <tr>
                <td><b>Model Year</b></td>
                <td>" . htmlspecialchars($rc_details['model_year']) . "</td>
              </tr>
              <tr>
                <td><b>Seating Capacity</b></td>
                <td>" . htmlspecialchars($rc_details['seating_capacity']) . "</td>
              </tr>
              <tr>
                <td><b>Engine Capacity</b></td>
                <td>" . htmlspecialchars($rc_details['engine_capacity']) . "</td>
              </tr>
              <tr>
                <td><b>Listed Price</b></td>
                <td>" . htmlspecialchars($rc_details['listed_price']) . "</td>
              </tr>
              <tr>
                <td><b>Usage Type</b></td>
                <td>" . htmlspecialchars($rc_details['usage_type']) . "</td>
              </tr>
              <tr>
                <td><b>Fitness Valid Upto</b></td>
                <td>" . htmlspecialchars($rc_details['fitness_validupto']) . "</td>
              </tr>";

    // Add afteraddons details
    $html .= "<br><br><br><br><br><br><tr><th colspan='2'>Afteraddons Details</th></tr><br><br>";
    $html .= "<tr>
                <td><b>Vehicle Number</b></td>
                <td>" . htmlspecialchars($afteraddons_details['vehicle_num']) . "</td>
              </tr>
              <tr>
                <td><b>Net Premium</b></td>
                <td>" . htmlspecialchars($afteraddons_details['netPremium']) . "</td>
              </tr>
              <tr>
                <td><b>Policies </b></td>
                <td>" . htmlspecialchars($afteraddons_details['addons']) . "</td>
              </tr>
              <tr>
                <td><b>Insured on</b></td>
                <td>" . htmlspecialchars($afteraddons_details['date_added']) . "</td>
              </tr>
              <tr>
                <td><b>Insurance Expiry on</b></td>
                <td>" . htmlspecialchars($afteraddons_details['due_date']) . "</td>
              </tr>";

    $html .= "</table>";

    // Add Total Paid if netPremium exists
    if (isset($afteraddons_details['netPremium'])) {
        $html .= "<br><br><br><br><div>
                  <br><br><p><b>Total Amount Paid &nbsp;:&nbsp; " . htmlspecialchars($afteraddons_details['netPremium']) . "</b></p>
                  </div>";
    }

    $html .= "<div class='invoice-footer'><br><br><br><br><br><br><br>
               <p><b>&quot; An insured journey is a journey with less worry &quot;<b></p><br><br><br><br><br>
                <p><b>&copy; 2024 Motor Insurance. All rights reserved.<b></p><br>
                <p style='position: absolute;  right: 3%;'><b>Generated on &nbsp;:&nbsp; $currentDateTime<b></p>
            </div>
        </div>
    </body>
    </html>";

    // Instantiate and use the Dompdf class
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF (force download)
    $dompdf->stream("invoice.pdf", array("Attachment" => 1));
    
    $stmt_customer->close();
    $stmt_rc->close();
    $stmt_credit_card->close();
    $stmt_afteraddons->close();
} else {
    echo "Vehicle number is missing.";
}

$conn->close();
?>
