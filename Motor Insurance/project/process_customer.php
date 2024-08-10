<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cname = $_POST['cname'];
    $cdob = $_POST['cdob'];
    $cphone_no = $_POST['cphone_no'];
    $cemail = $_POST['cemail'];
    $clicense = $_POST['clicense'];
    $caddress = $_POST['caddress'];

    $servername = "localhost";
    $username = "root";
    $password = "XXXXX";
    $dbname = "customer";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO customer (cname, cdob, cphone_no, cemail, clicense, caddress) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $cname, $cdob, $cphone_no, $cemail, $clicense, $caddress);

    if ($stmt->execute()) {
        // Success message or redirection can be added here
    } else {
        echo "Error: " . $stmt->error;
    }


     
    $stmt->close();
    $conn->close();
} else {
    $cname = '';
    $cemail = '';
}
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Motor Insurance</title>
<link rel="shortcut icon" type="x-icon" href="logo.png">
<style>
        
 body {
            font-family: Arial, sans-serif;
            margin: 0; /* Remove default margin to prevent scrolling issues */
            padding: 0;
            
        }
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('final1111.jpg') no-repeat center center fixed; /* Replace with your image path */
            background-size: cover;
            filter: blur(8px);
            z-index: -1; /* Ensure the pseudo-element is behind the content */
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto; /* Adjust margin for spacing */
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background for readability */
            padding: 20px;
            border-radius: 8px;
            position: relative; /* Necessary for proper z-index layering */
            z-index: 1;
        }
        form {
            margin-bottom: 40px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        
        input[type="text"],
        input[type="date"],
        input[type="email"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #003399; /* Blue background color */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #001a4d; /* Darker blue on hover */
        }
        select {
            background-color: white;
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
<a href="tech.html" class="home-icon">
    <img src="home.jpg" alt="Home">
</a>

<div class="form-container">
    <h2>RC Information Form</h2>
    <form action="process_rrc.php" method="POST" onsubmit="return validateForm()">

        <input type="hidden" id="name" name="cname" value="<?php echo htmlspecialchars($cname); ?>" required>
        <input type="hidden" id="email" name="cemail" value="<?php echo htmlspecialchars($cemail); ?>" required>
        <label for="vehicle_num">Vehicle Number:</label>
        <input type="text" id="vehicle_num" name="vehicle_num" placeholder="XX 00 XX 0000" required>

        <label for="registration_date">Registration Date:</label>
        <input type="date" id="registration_date" name="registration_date" required max="2024-08-01">

        <label for="chasi_number">Chassis Number:</label>
        <input type="text" id="chasi_number" name="chasi_number" required pattern="[A-HJ-NPR-Z0-9]{17}" maxlength="17" title="Please enter a valid 17-character chassis number (alphanumeric, no I, O, Q)">

        <label for="engine_number">Engine Number:</label>
        <input type="text" id="engine_number" name="engine_number" required pattern="[A-HJ-NPR-Z0-9]{8,17}" minlength="8" maxlength="17" title="Please enter a valid engine number (8-17 characters, alphanumeric, no I, O, Q)">

        <label for="wheel_type">Wheel Type:</label>
        <select id="wheel_type" name="wheel_type" required>
            <option value="Two wheeler">Two wheeler</option>
            <option value="Three wheeler">Three wheeler</option>
            <option value="Four wheeler">Four wheeler</option>
            <option value="Heavy Vehicle">Heavy Vehicle</option>
        </select>

        <label for="fuel_type">Fuel Type:</label>
        <select id="fuel_type" name="fuel_type" required>
            <option value="" disabled selected>Select fuel type</option>
            <option value="Petrol">Petrol</option>
            <option value="Diesel">Diesel</option>
            <option value="Electric">Electric</option>
        </select>

        <label for="brand">Brand Name:</label>
        <select id="brand" name="brand" required>
            <option value="Honda">Honda</option>
            <option value="Toyota">Toyota</option>
            <option value="Yamaha">Yamaha</option>
            <option value="Suzuki">Suzuki</option>
            <option value="Harley-Davidson">Harley-Davidson</option>
            <option value="Ducati">Ducati</option>
            <option value="Bajaj">Bajaj</option>
            <option value="Piaggio">Piaggio</option>
            <option value="Scania">Scania</option>
            <option value="Maruti Suzuki">Maruti Suzuki</option>
            <option value="Ford">Ford</option>
            <option value="Chevrolet">Chevrolet</option>
            <option value="BMW">BMW</option>
            <option value="Mercedes-Benz">Mercedes-Benz</option>
            <option value="Audi">Audi</option>
            <option value="Hyundai">Hyundai</option>
            <option value="Kia">Kia</option>
            <option value="Nissan">Nissan</option>
            <option value="Volkswagen">Volkswagen</option>
            <option value="Tesla">Tesla</option>
            <option value="Volvo">Volvo</option>
            <option value="Mahindra">Mahindra</option>
            <option value="Jeep">Jeep</option>
            <option value="MAN">MAN</option>
            <option value="Tata">Tata</option>
            <option value="Ashok Leyland">Ashok Leyland</option>
        </select>

        <label for="modell">Model:</label>
        <input type="text" id="modell" name="modell" required>

        <label for="model_year">Model Year:</label>
        <input type="number" id="model" name="model" min="2000" max="2500" required>

        <label for="seating_capacity">Seating Capacity:</label>
        <input type="number" id="seating_capacity" name="seating_capacity" min="1" max="60" required>
        <span id="error-message" style="color: red;"></span>

        <label for="engine_capacity">Engine Capacity (cc):</label>
        <input type="number" id="engine_capacity" name="engine_capacity" min="99" max="5000" required>
        <span id="engine_capacity_error" style="color: red;"></span>

        <label for="listed_price">Listed Price:</label>
        <input type="number" id="listed_price" name="listed_price" min="60000" required>
        <span id="listed_price_error" style="color: red;"></span>

        <label for="usage_type">Usage Type:</label>
        <select id="usage_type" name="usage_type" required>
            <option value="Private">Private</option>
            <option value="Public">Public</option>
        </select>

        <label for="fitness_validupto">Fitness Valid Up To:</label>
        <input type="date" id="fitness_validupto" name="fitness_validupto" required min="2024-08-01" max="2029-08-01">
        <span id="fitness_error" style="color: red;"></span>

        <input type="submit" value="Submit">
    </form>
</div>

<script>
function validateForm() {
    const errorMessage = document.getElementById('error-message');

    // Validate seating capacity
    const seatingCapacityInput = document.getElementById('seating_capacity');
    const seatingCapacityValue = parseInt(seatingCapacityInput.value, 10);

    if (!Number.isInteger(seatingCapacityValue) || seatingCapacityValue < 1 || seatingCapacityValue > 50) {
        errorMessage.textContent = 'Please enter a valid seating capacity between 1 and 50.';
        seatingCapacityInput.focus();
        return false; // Prevent form submission
    }

    // Validate chassis number
    const chassisNumber = document.getElementById('chasi_number').value;
    const chassisPattern = /^[A-HJ-NPR-Z0-9]{17}$/;

    if (!chassisPattern.test(chassisNumber)) {
        alert('Please enter a valid 17-character chassis number (alphanumeric, no I, O, Q)');
        return false; // Prevent form submission
    }

    // Validate engine number
    const engineNumber = document.getElementById('engine_number').value;
    const enginePattern = /^[A-HJ-NPR-Z0-9]{8,17}$/;

    if (!enginePattern.test(engineNumber)) {
        alert('Please enter a valid engine number (8-17 characters, alphanumeric, no I, O, Q)');
        return false; // Prevent form submission
    }

    // Validate model year against registration year
    const registrationDateInput = document.getElementById('registration_date');
    const modelYearInput = document.getElementById('model');
    const registrationDate = new Date(registrationDateInput.value);
    const modelYear = parseInt(modelYearInput.value, 10);

    if (modelYear > registrationDate.getFullYear()) {
        alert('Model year cannot be greater than the registration year.');
        return false; // Prevent form submission
    }

    // Validate engine capacity
    const engineCapacityInput = document.getElementById('engine_capacity');
    const engineCapacityValue = parseInt(engineCapacityInput.value, 10);

    if (!Number.isInteger(engineCapacityValue) || engineCapacityValue < 99 || engineCapacityValue > 5000) {
        document.getElementById('engine_capacity_error').textContent = 'Please enter a valid engine capacity between 99cc and 5000cc.';
        return false; // Prevent form submission
    } else {
        document.getElementById('engine_capacity_error').textContent = '';
    }

    // Validate listed price
    const listedPriceInput = document.getElementById('listed_price');
    const listedPriceValue = parseInt(listedPriceInput.value, 10);

    if (!Number.isInteger(listedPriceValue) || listedPriceValue < 60000) {
        document.getElementById('listed_price_error').textContent = 'Please enter a valid listed price, greater than or equal to 60000.';
        return false; // Prevent form submission
    } else {
        document.getElementById('listed_price_error').textContent = '';
    }

    // Validate fitness date
    const fitnessInput = document.getElementById('fitness_validupto');
    const fitnessDate = new Date(fitnessInput.value);
    const currentDate = new Date();

    if (fitnessDate <= currentDate) {
        document.getElementById('fitness_error').textContent = 'Fitness valid date must be in the future.';
        return false; // Prevent form submission
    } else {
        document.getElementById('fitness_error').textContent = '';
    }

    return true; // Allow form submission
}
</script>

</body>
</html>