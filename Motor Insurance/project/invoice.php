<?php

require 'vendor2/autoload.php'; // include the Composer autoload file

use Dompdf\Dompdf;

$servername = "localhost";
$username = "root";
$password = "XXXXX";
$dbname = "customer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_customer = "SELECT * FROM customer ORDER BY cid DESC LIMIT 1";
$result_customer = $conn->query($sql_customer);
$latest_customer = $result_customer->fetch_assoc();

$sql_rc = "SELECT * FROM rc ORDER BY id DESC LIMIT 1";
$result_rc = $conn->query($sql_rc);
$latest_rc = $result_rc->fetch_assoc();

$sql_payment = "SELECT * FROM payment_details ORDER BY payment_date DESC LIMIT 1";
$result_payment = $conn->query($sql_payment);
$latest_payment = $result_payment->fetch_assoc();

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
        .download-button {
            background-color: #005c99;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .download-button:hover {
            background-color: #2952a3;
        }
        .invoice-body table th, .invoice-body table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }
        .invoice-body table th {
            background:  #ccccff;
            font-weight: 600;
        }
        .invoice-footer {
            margin-top: 20px;
            text-align: right;
        }
        .invoice-footer .total {
            font-size: 20px;
            font-weight: bold;
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
                <h1>MOTOR INSURANCE COMPANY</h1></center>
                <p>7th-Main Road</p>
                <p>Coimbatore-641004</p>
            </div>
            <div class="invoice-details">
                <p>Invoice #: 03</p>
            </div>
        </div>
        <div class="invoice-body">
            <div class="client-details">
                <h2><i>INSURANCE COPY TO:</i></h2>
                <p>' . htmlspecialchars($latest_customer['cname']) . '</p>
                <p>' . htmlspecialchars($latest_customer['caddress']) . '</p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Vehicle Number</th>
                        <th>Net Premium</th>
                        <th>Payment Date</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>' . htmlspecialchars($latest_rc['name']) . '</td>
                        <td>' . htmlspecialchars($latest_rc['vehicle_num']) . '</td>
                        <td>' . htmlspecialchars($latest_payment['amount']) . '</td>
                        <td>' . htmlspecialchars($latest_payment['payment_date']) . '</td>
                        <td>' . htmlspecialchars($latest_payment['amount']) . '</td>
                    </tr>
                </tbody>
            </table>
            <div class="invoice-footer">
                <p class="total">Total Paid: ' . htmlspecialchars($latest_payment['amount']) . '</p>
            </div>
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

// Save the PDF to a file on the server
// file_put_contents('path/to/save/invoice.pdf', $dompdf->output());

?>