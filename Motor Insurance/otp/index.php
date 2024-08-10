<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motor Insurance</title>
    <link rel=" shortcut icon" type="x-icon" href="logo1.png">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body and Canvas */
        body {
            font-family: 'Arial', sans-serif;
            color: #fff;
            overflow: hidden;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url("se.jpg");
            background-size: cover;
            background-position: center;
        }

        canvas#backgroundCanvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        /* Container */
        .container {
            position: relative;
            width: 90%;
            max-width: 400px;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
        }

        

        /* Heading */
        h1 {
            margin-bottom: 20px;
            font-size: 2.5em;
            color: #FFD700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            transition: color 0.3s ease;
        }

        h1:hover {
            color: #FFC107;
        }

        /* Form */
        .form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 1.2em;
            color: #ddd;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            outline: none;
            font-size: 1em;
            transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        input:focus {
            border-color: #FFD700;
            box-shadow: 0 0 8px rgba(255, 215, 0, 0.5);
        }

        /* Button */
        .btn {
            background: #FFD700;
            border: none;
            color: #000;
            padding: 12px 24px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1em;
            transition: background-color 0.3s ease-in-out, transform 0.2s ease-in-out;
        }

        .btn:hover {
            background: #FFC107;
            transform: scale(1.05);
        }

        /* Response Message */
        .response-message {
            font-size: 1.1em;
            margin-top: 20px;
            color: #FFD700;

        }

        .autocomplete-highlight {
            background-color: #fff3cd; /* Light yellow background */
            border: 1px solid #ffeeba; /* Light yellow border */
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            font-size: 1.1em;
            color: #856404; /* Dark yellow text */
        }


        .home-icon {
            position: fixed;
            top: 6%;
            left: 6%;
            z-index: 10;
        }

        .home-icon img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .home-icon img:hover {
            transform: scale(1.1);
        }

        .back-icon {
            position: fixed;
            top: 6%;
            left: 88%;
            z-index: 10;
        }

        .back-icon .back-img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .back-icon .back-img:hover {
            transform: scale(1.1);
        }



        /* Responsive Styles */
        @media (max-width: 768px) {
            h1 {
                font-size: 2em;
            }

            .btn {
                font-size: 1em;
                padding: 10px 20px;
            }

            .home-icon {
                top: 4%;
                left: 4%;
            }

            .home-icon img {
                width: 50px;
                height: 50px;
            }

            .back-icon {
                top: 4%;
                left: 89%;
            }

            .back-icon .back-img {
                width: 50px;
                height: 50px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
                max-width: 90%;
            }

            h1 {
                font-size: 1.8em;
            }


            .home-icon {
                top: 4%;
                left: 4%;
            }

            .home-icon img {
                width: 50px;
                height: 50px;
            }

            .back-icon {
                top: 4%;
                left: 83%;
            }

            .back-icon .back-img {
                width: 50px;
                height: 50px;
            }

            input, .btn {
                font-size: 0.9em;
            }

            .btn {
                padding: 10px 15px;
            }
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

            <script>
                $(document).ready(function(){
                $("#b1").hide();
                $("#1b").click(function(){
                $("#1b").hide();
                });
                $("#2b").click(function(){
                $("#2b").hide();
                $("#b1").show();
                });
            });
            </script>


</head>
<body>
    <canvas id="backgroundCanvas"></canvas>
    <a href="../project/new1.html" class="home-icon">
    <img src="home.jpg" alt="Home">
    </a>
    <a href="../project/new1.html" class="back-icon">
        <img src="left-arrow.png" class="back-img" alt="Back">
    </a>
    <div class="container">
        <h1>OTP Verification</h1>
        <form id="otpForm" class="form">
            <label for="email">Enter Email Address:</label>
            <input type="email" id="email" name="email" placeholder="example@example.com" required>
            <button type="button" class="btn" id="1b" onclick="sendOTP()">Send OTP</button>
        </form>
        <form id="otpVerifyForm" class="form" style="display:none;">
            <label for="otp">Enter OTP:</label>
            <input type="text" id="otp" name="otp" placeholder="123456" required>
            <button type="button" class="btn" id="2b" onclick="verifyOTP()">Verify OTP</button>
        </form>
        <p id="response" class="response-message" ></p><br><br> <button id="b1" class="btn" onclick="validate()"> CLICK </button>
    </div>
    <script>
        // Canvas Animation
        const canvas = document.getElementById('backgroundCanvas');
        const ctx = canvas.getContext('2d');
        
        let particles = [];

        function createParticle(x, y) {
            return {
                x: x,
                y: y,
                size: Math.random() * 0.5,
                speedX: Math.random() * 0.3,
                speedY: Math.random() * 0.3,
                color: 'rgba(255, 255, 255, 0.7)'
            };
        }

        function drawParticle(particle) {
            ctx.beginPath();
            ctx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
            ctx.fillStyle = particle.color;
            ctx.fill();
        }

        function updateParticles() {
            particles.forEach(p => {
                p.x += p.speedX;
                p.y += p.speedY;
                if (p.x > canvas.width || p.x < 0 || p.y > canvas.height || p.y < 0) {
                    p.x = Math.random() * canvas.width;
                    p.y = Math.random() * canvas.height;
                }
            });
        }

        function drawBackground() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Create a gradient
            const gradient = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
            gradient.addColorStop(0, 'rgba(0, 0, 0, 0.5)');
            gradient.addColorStop(1, 'rgba(0, 0, 0, 0.2)');

            ctx.fillStyle = gradient;
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            // Draw particles
            if (particles.length < 100) {
                for (let i = 0; i < 100; i++) {
                    particles.push(createParticle(Math.random() * canvas.width, Math.random() * canvas.height));
                }
            }

            particles.forEach(p => drawParticle(p));
            updateParticles();

            requestAnimationFrame(drawBackground);
        }

        drawBackground();

        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });

        function sendOTP() {
            document.getElementById('otpForm').style.display = 'none';
            document.getElementById('otpVerifyForm').style.display = 'block';
            document.getElementById('response').textContent = 'OTP sent to your email.';
        }

        function verifyOTP() {
            document.getElementById('response').textContent = 'OTP verified successfully!';
        }
        function validate(){
            const responseText = document.getElementById('response').textContent;
            const expectedText = 'OTP verified successfully!';
            if (responseText === expectedText) {
                window.alert('OTP verified successfully!');
                window.location.href = '../project/login.html';
            } else {
                location.reload();
            }
        }
    </script>



    <script src="sendOtp.js"></script>
</body>
</html>
