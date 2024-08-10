<?php

require 'vendor2/autoload.php'; // include the Composer autoload file

use Dompdf\Dompdf;

// Get parameters from URL
$name = $_GET['name'];
$vehicle_num = $_GET['vehicle_num'];

$servername = "localhost";
$username = "root";
$password = "XXXXX";
$dbname = "customer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch customer details
$sql_customer = "SELECT * FROM customer WHERE cname='$name'";
$result_customer = $conn->query($sql_customer);
$latest_customer = $result_customer->fetch_assoc();

// Fetch claim details
$sql_claim = "SELECT * FROM claim WHERE cname='$name' AND vehicle_num='$vehicle_num'";
$result_claim = $conn->query($sql_claim);
$claim_details = $result_claim->fetch_assoc();

// Fetch request claim details
$sql_request_claim = "SELECT * FROM request_claim WHERE cname='$name' AND vehicle_num='$vehicle_num' ORDER BY date_time DESC LIMIT 1";
$result_request_claim = $conn->query($sql_request_claim);
$request_claim_details = $result_request_claim->fetch_assoc();

$conn->close();

// Create the HTML content
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: \'Helvetica Neue\', \'Helvetica\', Arial, sans-serif;
            background-color: #ccddff;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .invoice-container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
        }
        .invoice-header h1 {
            font-size: 24px;
            margin: 0;
        }
        .invoice-header .company-details, .invoice-header .invoice-details {
            text-align: right;
        }
        .invoice-header .company-details p, .invoice-header .invoice-details p {
            margin: 0;
        }
        .invoice-body {
            margin: 20px 0;
        }
        .invoice-body .client-details {
            margin-bottom: 20px;
        }
        .invoice-body .client-details p {
            margin: 0;
        }
        .invoice-body table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-body table th, .invoice-body table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }
        .invoice-body table th {
            background: #ccccff;
            font-weight: 600;
        }
        .invoice-footer {
            margin-top: 20px;
            text-align: right;
        }
        .center-button {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <div class="company-details">
                <center>
                    <h1>MOTOR INSURANCE</h1>
                </center>
            </div>
            <div class="invoice-details">
                
            </div>
        </div>
        <div class="invoice-body">
            <div class="client-details">
                <h2><i>CUSTOMER DETAILS:</i></h2>
                <p>Name: ' . htmlspecialchars($latest_customer['cname']) . '</p>
                <p>License: ' . htmlspecialchars($latest_customer['clicense']) . '</p>
                <p>DOB: ' . htmlspecialchars($latest_customer['cdob']) . '</p>
                <p>Phone: ' . htmlspecialchars($latest_customer['cphone_no']) . '</p>
                <p>Email: ' . htmlspecialchars($latest_customer['cemail']) . '</p>
                <p>Address: ' . htmlspecialchars($latest_customer['caddress']) . '</p>
            </div>
            <h2><i>CLAIM DETAILS:</i></h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Vehicle Number</th>
                        <th>Claim Type</th>
                        <th>Claim Details</th>
                        <th>Place</th>
                        <th>Pincode</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>' . htmlspecialchars($claim_details['cname']) . '</td>
                        <td>' . htmlspecialchars($claim_details['vehicle_num']) . '</td>
                        <td>' . htmlspecialchars($claim_details['claim_type']) . '</td>
                        <td>' . htmlspecialchars($claim_details['claim_details']) . '</td>
                        <td>' . htmlspecialchars($claim_details['place']) . '</td>
                        <td>' . htmlspecialchars($claim_details['pincode']) . '</td>
                    </tr>
                </tbody>
            </table>
            <h2><i>REQUEST  :</i></h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Vehicle Number</th>
                        <th>Date Time</th>
                        <th>Request</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>' . htmlspecialchars($request_claim_details['cname']) . '</td>
                        <td>' . htmlspecialchars($request_claim_details['vehicle_num']) . '</td>
                        <td>' . htmlspecialchars($request_claim_details['date_time']) . '</td>
                        <td>' . htmlspecialchars($request_claim_details['request']) . '</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <center>
            <p>&copy; 2024 Motor Insurance Company. All rights reserved.</p>
        </center>
    </div>
</body>
</html>
';

// Initialize Dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Output the generated PDF to browser
$dompdf->stream("invoice.pdf", ["Attachment" => false]);

?>
