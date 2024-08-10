<?php
header('Access-Control-Allow-Origin: *'); // Allow requests from any origin
header('Content-Type: application/json');

include 'db_conn.php';
require 'vendor3/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['email'])) {
    $email = $input['email'];

    // Prepare and execute the statement
    $stmt = $conn->prepare("SELECT * FROM customer WHERE cemail = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the email exists
    if ($result->num_rows > 0) {
        // Generate OTP
        $otp = rand(100000, 999999);

        // Store OTP in session or database for later verification
        $_SESSION['otp'] = $otp;

        try {
            $mail = new PHPMailer(true);
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;



            $mail->Username = 'example@gmail.com';                               // Replace with your Gmail address
            $mail->Password = '16 digit PASSCODE';                               // Replace with your App Password




            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('example@gmail.com', 'MOTOR INSURANCE'); // Replace with your Gmail address
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your OTP Code';
            $mail->Body = 'MOTOR INSURENCE Your SignIn  OTP is ' . $otp;

            $mail->send();
            echo json_encode(['message' => 'OTP sent successfully!']);
        } catch (Exception $e) {
            error_log('Error sending OTP: ' . $mail->ErrorInfo);
            echo json_encode(['message' => 'Error sending OTP: ' . $mail->ErrorInfo]);
        }
    } else {
        echo json_encode(['message' => 'Email does not exist. Please create an account.']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['message' => 'Email address is required.']);
}
?>
