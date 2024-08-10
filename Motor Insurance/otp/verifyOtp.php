<?php
session_start();

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['otp'])) {
    $enteredOtp = $input['otp'];
    $storedOtp = isset($_SESSION['otp']) ? $_SESSION['otp'] : null;

    if ($enteredOtp == $storedOtp) {
        // OTP is valid
        unset($_SESSION['otp']); // Remove OTP from session after verification
        echo json_encode(['message' => 'OTP verified successfully!']);
    } else {
        // OTP is invalid
        echo json_encode(['message' => 'Invalid OTP. Please reload the page and enter the correct email.']);
    }
} else {
    echo json_encode(['message' => 'OTP is required.']);
}
?>
