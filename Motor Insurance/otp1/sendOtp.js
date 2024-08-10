function sendOTP() {
    const email = document.getElementById('email').value.trim();

    if (email === "") {
        alert("Please enter a valid email address");
        return;
    }

    fetch('sendOtp.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: email })
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('response').innerText = data.message;
        if (data.message === 'OTP sent successfully!') {
            document.getElementById('otpVerifyForm').style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('response').innerText = "Error sending OTP";
    });
}

function verifyOTP() {
    const otp = document.getElementById('otp').value.trim();

    if (otp === "") {
        alert("Please enter the OTP");
        return;
    }

    fetch('verifyOtp.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ otp: otp })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response data:', data); // Log the response data
        document.getElementById('response').innerText = data.message;
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('response').innerText = "Error verifying OTP";
    });
}
