<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <title>Motor Insurance</title>
        <link rel=" shortcut icon" type="x-icon" href="logo.png">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('final1111.jpg') no-repeat center center fixed; /* Replace with your image path */
            background-size: cover;
            
            z-index: 0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            position: absolute;
            top: 8%;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 2s ease-in-out;
        }

        h1 {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .button {
            width: 100%;
            padding: 10px;
            background: linear-gradient(to bottom, #336699 0%, #33cccc 100%);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button:hover {
            background: linear-gradient(to bottom, #009999 0%, #00cc99 100%);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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

        @media (max-width: 768px) {
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

            .container {
                position : absolute;
                top:12%;
                width : 72%;
                height: 100%;
            }
        }

        @media (max-width: 480px) {

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
            .container {
                position : absolute;
                top:13%;
                width : 82%;
                height: 130%;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <?php
        if (isset($_GET['name']) && isset($_GET['vehicle_num'])) {
            $name = htmlspecialchars($_GET['name']);
            $vehicle_num = htmlspecialchars($_GET['vehicle_num']);
            // Process the variables as needed
        } else {
            echo "No parameters received.";
        }
    ?>
    <a href="new.html" class="home-icon">
        <img src="home.jpg" alt="Home">
    </a>
    <a href="display.php?name=<?php echo urlencode($name); ?>&vehicle_num=<?php echo urlencode($vehicle_num); ?>" class="back-icon">
        <img src="left-arrow.png" class="back-img" alt="Back">
    </a><br><br><br>
    <div class="blur-background"></div>
    <div class="container">
        <h1><i>VEHICLE INSURANCE CLAIMING</i></h1>
        <hr>
        <?php
        if (isset($name) && isset($vehicle_num)) {
            echo '<b>NAME:</b> ' . htmlspecialchars($name) . '<br><br>';
            echo '<b>VEHICLE NUMBER:</b> ' . htmlspecialchars($vehicle_num) . '<br><br>';
        }
        ?>
        <form action="photo.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="name" name="name1" value="<?php echo htmlspecialchars($name); ?>" required>
            <input type="hidden" id="vehicle" name="vehicle1" value="<?php echo htmlspecialchars($vehicle_num); ?>" required>
            <label for="claim_type"><b><br>Claim Type:</b></label>
            <select id="claim_type" name="claim_type" required>
                <option value="third_party"><b>Third Party</b></option>
                <option value="own_damage"><b>Own Damage</b></option>
                <option value="Comprehensive"><b>Comprehensive</b></option>
                <option value="others"><b>Others</b></option>
            </select>
            <label for="details1"><b>Cause of Claiming:</b></label>
            <textarea id="details1" name="details1" rows="4" required placeholder="Enter Cause of Claiming "></textarea>
            <label for="details2"><b>Brief the Cause of Claiming:</b></label>
            <textarea id="details2" name="details2" rows="4" required placeholder="Enter Brief the Cause of Claiming "></textarea>
            <label for="details3"><b>Place:</b></label>
            <textarea id="details3" name="details3" rows="4" required placeholder="Enter Place "></textarea>
            <label for="details4"><b>Pincode:</b></label>
            <input type="number"  id="details4"   name="details4"  required  min="100000"  max="999999"  pattern="\d{6}"  title="Please enter a 6-digit pincode"  placeholder="Enter 6-digit pincode"><br><br><br><br>
            <input type="submit" class="button" name="mysubmit" value="NEXT">
        </form>
    </div>
</body>
</html>
