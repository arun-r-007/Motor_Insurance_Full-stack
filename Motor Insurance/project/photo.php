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
            z-index: -1;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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

        .container {
            position: absolute;
            top: 8%;
            width: 32%;
            background: white;
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

        button {
            width: 100%;
            padding: 10px;
            background: linear-gradient(to bottom, #336699 0%, #33cccc 100%);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: linear-gradient(to bottom, #009999 0%, #00cc99 100%);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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
                position: absolute;
                top: 12%;
                width: 72%;
                height: auto;
            }
        }

        @media (max-width: 480px) {
            .container {
                position: absolute;
                top: 15%;
                width: 82%;
                height: auto;
            }

            .home-icon {
                top: 4%;
                left: 4%;
            }

            .home-icon img {
                width: 50px;
                height: 50px;
            }
            h2{
                font-size:91%;
            }
            .h22{
                font-size:84%;
            }

            .back-icon {
                top: 4%;
                left: 83%;
            }

            .back-icon .back-img {
                width: 50px;
                height: 50px;
            }
        }
    </style>
</head>
<body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "XXXXX";
        $dbname = "customer";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name1'];
            $vehicle_num = $_POST['vehicle1'];
            $claim_type = $_POST['claim_type'];
            $details1 = $_POST['details1'];
            $details2 = $_POST['details2'];
            $details3 = $_POST['details3'];
            $details4 = $_POST['details4'];
            $sql = "INSERT INTO claim (cname, vehicle_num, claim_type, claim_details, cause_of_claiming, place, pincode) VALUES ('$name', '$vehicle_num', '$claim_type', '$details1', '$details2', '$details3', '$details4')";
            if ($conn->query($sql) === TRUE) {
                //echo "Claim submitted successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        } else {
            echo "Invalid request method.";
        }
    ?>
<a href="new1.html" class="home-icon">
        <img src="home.jpg" alt="Home">
    </a>
    <a href="claim.php?name=<?php echo urlencode($name); ?>&vehicle_num=<?php echo urlencode($vehicle_num); ?>" class="back-icon">
        <img src="left-arrow.png" class="back-img" alt="Back">
    </a>
<div class="blur-background"></div>
    <div class="container">
        <h1><i>INSURANCE CLAIMING</i></h1><hr>
            
            <form action="upload.php" method="POST" enctype="multipart/form-data">
            <h2><b>UPLOAD VEHICLE IMAGES</b></h2><h2 style="color: red;" class="h22" ><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( within size 2 MB )</b></h2><br>
            
            <input type="hidden" id="name1" name="name1" value="<?php echo $name; ?>" required>
            <input type="hidden" id="vehicle1" name="vehicle1" value="<?php echo $vehicle_num; ?>" required>

            <label for="vehicleImage1"><b>IMAGE 1</b></label>
            <h3 style="color: red;">(With Vehicle NUMBER)</h3>
            <input type="file" name="vehicleImage1" id="vehicleImage1" accept=".jpg, .jpeg, .png" required>
            
            <label for="vehicleImage2"><b>IMAGE 2</b></label>
            <h3 style="color: red;">(Vehicle NUMBER PLATE)</h3>
            <input type="file" name="vehicleImage2" id="vehicleImage2" accept=".jpg, .jpeg, .png" required>
            
            <label for="vehicleImage3"><b>IMAGE 3</b></label>
            <input type="file" name="vehicleImage3" id="vehicleImage3" accept=".jpg, .jpeg, .png" required>
            
            <label for="vehicleImage4"><b>IMAGE 4<b></label>
            <input type="file" name="vehicleImage4" id="vehicleImage4" accept=".jpg, .jpeg, .png" required>
            
            <label for="vehicleImage5"><b>IMAGE 5</b></label>
            <input type="file" name="vehicleImage5" id="vehicleImage5" accept=".jpg, .jpeg, .png" required><br><br>
            
                <button type="submit" class="button2"><h3><b>CLAIM INSURANCE</b></h3></button>
            </form>
    </div>
</body>
</html>
