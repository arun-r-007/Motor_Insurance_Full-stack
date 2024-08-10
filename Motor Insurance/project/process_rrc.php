<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['cname'];
    $email = $_POST['cemail'];
    $vehicle_num = $_POST['vehicle_num'];
    $registration_date = $_POST['registration_date'];
    $chasi_number = $_POST['chasi_number'];
    $engine_number = $_POST['engine_number'];
    $wheel_type = $_POST['wheel_type'];
    $fuel_type = $_POST['fuel_type'];
    $brand = $_POST['brand'];
    $modell = $_POST['modell'];
    $model_year = $_POST['model'];
    $seating_capacity = $_POST['seating_capacity'];
    $engine_capacity = $_POST['engine_capacity'];
    $listed_price = $_POST['listed_price'];
    $usage_type = $_POST['usage_type'];
    $fitness_validupto = $_POST['fitness_validupto'];

    $servername = "localhost";
    $username = "root";
    $password = "XXXXX";
    $dbname = "customer";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    

    $stmt = $conn->prepare("INSERT INTO rc (name, vehicle_num, registration_date, chasi_number, engine_number, wheel_type, fuel_type, brand, modell, model_year, seating_capacity, engine_capacity, listed_price, usage_type, fitness_validupto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssssss", $name, $vehicle_num, $registration_date, $chasi_number, $engine_number, $wheel_type, $fuel_type, $brand, $modell, $model_year, $seating_capacity, $engine_capacity, $listed_price, $usage_type, $fitness_validupto);

    if ($stmt->execute()) {
        echo "<script>alert('Vehicle Details Uploaded');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt1 = $conn->prepare("INSERT INTO curc (name,vehicle_num,cemail) VALUES (?, ?, ?)");
    $stmt1->bind_param("sss", $name,$vehicle_num,$email );

    if ($stmt1->execute()) {
        // Success message or redirection can be added here
    } else {
        echo "Error: " . $stmt1->error;
    }



    $stmt->close();
    $stmt1->close();

    $sql_customer = "SELECT * FROM customer ORDER BY cid DESC LIMIT 1";
    $result_customer = $conn->query($sql_customer);
    $latest_customer = $result_customer->fetch_assoc();

    $conn->close();
    
    $latest_customer_name = $latest_customer['cname'];
    
    echo "<script>
            var vehicle_num = " . json_encode($vehicle_num) . ";
            var customer_name = " . json_encode($latest_customer_name) . ";

            $(document).ready(function() {
                $('.button').on('click', function() {
                    // Encode the parameters
                    var encodedVehicleNum = encodeURIComponent(vehicle_num);
                    var encodedCustomerName = encodeURIComponent(customer_name);

                    // Construct the URL
                    var url = 'photo1.php?vehicle_num=' + encodedVehicleNum + '&customer_name=' + encodedCustomerName;

                    // Redirect to the URL
                    window.location.href = url;
                });
            });
        </script>";
}

$servername = "localhost";
$username = "root";
$password = "XXXXX";
$dbname = "customer";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql_customer = "SELECT * FROM customer ORDER BY cid DESC LIMIT 1";
$result_customer = $conn->query($sql_customer);
$latest_customer = $result_customer->fetch_assoc();

$sql_rc = "SELECT * FROM rc ORDER BY id DESC LIMIT 1";
$result_rc = $conn->query($sql_rc);
$latest_rc = $result_rc->fetch_assoc();

$conn->close();
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Motor Insurance</title>
<link rel=" shortcut icon" type="x-icon" href="logo.png">

    <style>
       
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background: url('final1111.jpg') no-repeat center center fixed;
            background-size: cover;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            
        }
        .content {
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: 20px;
            width: 90%;
            max-width: 800px;
            animation: fadeIn 2s ease-in-out;
        }
        h2 {
            color: #444;
            font-size: 28px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #ddd;
        }
        h3 {
            color: #666;
            font-size: 20px;
            margin: 20px 0;
        }
        img {
            margin-top: 20px;
            width: 150px;
            height: auto;
        }
        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .button {
            background: #0066cc;
            color: #fff;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 30px;
            transition: background 0.3s ease;
        }
        .button:hover {
            background: #005bb5;
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

     <div class="blur-background"></div>
        <div class="content">

<center>
    <h2>CUSTOMER DETAILS</h2>
    <table>
        <tr><th>Customer ID</th><td><?php echo $latest_customer['cid']; ?></td></tr>
        <tr><th>Name</th><td><?php echo $latest_customer['cname']; ?></td></tr>
        <tr><th>Date of Birth</th><td><?php echo $latest_customer['cdob']; ?></td></tr>
        <tr><th>Phone Number</th><td><?php echo $latest_customer['cphone_no']; ?></td></tr>
        <tr><th>Email</th><td><?php echo $latest_customer['cemail']; ?></td></tr>
        <tr><th>License Number</th><td><?php echo $latest_customer['clicense']; ?></td></tr>
        <tr><th>Address</th><td><?php echo $latest_customer['caddress']; ?></td></tr>
    </table>

    <h2>RC DETAILS</h2>
    <table>
        <tr><th>Name</th><td><?php echo $latest_rc['name']; ?></td></tr>
        <tr><th>Vehicle Number</th><td><?php echo $latest_rc['vehicle_num']; ?></td></tr>
        <tr><th>Registration Date</th><td><?php echo $latest_rc['registration_date']; ?></td></tr>
        <tr><th>Chasis Number</th><td><?php echo $latest_rc['chasi_number']; ?></td></tr>
        <tr><th>Engine Number</th><td><?php echo $latest_rc['engine_number']; ?></td></tr>
        <tr><th>Wheel Type</th><td><?php echo $latest_rc['wheel_type']; ?></td></tr>
        <tr><th>Fuel Type</th><td><?php echo $latest_rc['fuel_type']; ?></td></tr>
        <tr><th>Brand</th><td><?php echo $latest_rc['brand']; ?></td></tr>
        <tr><th>Model</th><td><?php echo $latest_rc['modell']; ?></td></tr>
        <tr><th>Model Year</th><td><?php echo $latest_rc['model_year']; ?></td></tr>
        <tr><th>Seating Capacity</th><td><?php echo $latest_rc['seating_capacity']; ?></td></tr>
        <tr><th>Engine Capacity</th><td><?php echo $latest_rc['engine_capacity']; ?></td></tr>
        <tr><th>Listed Price</th><td><?php echo $latest_rc['listed_price']; ?></td></tr>
        <tr><th>Usage Type</th><td><?php echo $latest_rc['usage_type']; ?></td></tr>
        <tr><th>Fitness Valid Up To</th><td><?php echo $latest_rc['fitness_validupto']; ?></td></tr>
    </table>
    <br><br>
    <button class="button" onclick="loaddetails()" >UPLOAD &nbsp;VEHICLE &nbsp; PHOTOS</button>
    <div id="policyDetails"></div></div>
</center>
</body>

<script>
    function loaddetails() {
        var netPremium;
        var basePremium, yearFactor = 0.05, seatFactor = 0.02, depreciationRate, idv;
        var currentYear = new Date().getFullYear();
        var vehicleAge = currentYear - <?php echo json_encode($latest_rc['model_year']); ?>;

        <?php if (isset($latest_rc['vehicle_num'], $latest_rc['wheel_type'], $latest_rc['engine_capacity'], $latest_rc['model_year'], $latest_rc['listed_price'], $latest_rc['seating_capacity'])): ?>
            var vehicle_num = <?php echo json_encode($latest_rc['vehicle_num']); ?>;
            var wheel_type = <?php echo json_encode($latest_rc['wheel_type']); ?>;
            var engine_capacity = <?php echo json_encode($latest_rc['engine_capacity']); ?>;
            var model_year = <?php echo json_encode($latest_rc['model_year']); ?>;
            var listed_price = <?php echo json_encode($latest_rc['listed_price']); ?>;
            var seating_capacity = <?php echo json_encode($latest_rc['seating_capacity']); ?>;
          
        <?php endif; ?>

    }
</script>

</html>
