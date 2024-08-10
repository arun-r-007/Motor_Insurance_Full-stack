<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motor Insurance</title>
    <link rel="shortcut icon" type="x-icon" href="logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('building2.jpg') no-repeat center center fixed; /* Replace with your image path */
            background-size: cover;
            z-index: -1;
        }
        .content {
            width: 23%;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: 20px;
        }
        h2 {
            background-color: #005c99;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin: 0 0 20px 0;
        }
        h3 {
            color: #333;
        }
        img {
            margin-top: 20px;
            width: 150px;
            height: auto;
        }
        .blur-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: inherit;
            filter: blur(10px);
            z-index: -1;
        }
        footer {
            background: rgba(255, 255, 255, 0.8);
            width: 100%;
            padding: 10px 0;
            text-align: center;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
            position: absolute;
            bottom: 0;
            left: 0;
        }
        .contact {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }
        .contact div {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .contact img {
            width: 30px;
            height: auto;
        }
        .contact span {
            font-size: 16px;
            color: #333;
        }
        .home-icon {
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .home-icon img {
            width: 50px;
            height: 50px;
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
        }
        .download-button:hover {
            background-color: #2952a3;
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
        @media (max-width: 768px) {
            .home-icon {
                top: 4%;
                left: 4%;
            }
            .home-icon img {
                width: 50px;
                height: 50px;
            }
        }
        @media (max-width: 480px) {
            .content {
                width: 80%;
            }
            .home-icon {
                top: 4%;
                left: 4%;
            }
            .home-icon img {
                width: 50px;
                height: 50px;
            }
        }
    </style>
</head>
<body>
<a href="new1.html" class="home-icon">
    <img src="home.jpg" alt="Home">
</a>
<br><br>
<div class="content">
    <h2>PAYMENT SUCCESSFUL</h2>
    <img src='success.gif' alt='Success'>
    <h3>Your Payment was successful.</h3>
    <p>The vehicle number is: <strong><?php echo htmlspecialchars($_GET['vehicle_num'], ENT_QUOTES, 'UTF-8'); ?></strong></p>
    <?php if (isset($_GET['net_premium'])): ?>
        <p>The amount paid is: <strong><?php echo htmlspecialchars($_GET['net_premium'], ENT_QUOTES, 'UTF-8'); ?></strong></p>
    <?php endif; ?>
    <br><br>
    <a href="invoicenew.php?vehicle_num=<?php echo htmlspecialchars($_GET['vehicle_num'], ENT_QUOTES, 'UTF-8'); ?>" class="download-button">Download Invoice</a><br><br><br><br>
    <a href="new1.html" class="download-button">Back To Home</a><br><br>
</div>
</body>
</html>
