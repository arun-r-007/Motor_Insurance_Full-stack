<?php
$vehicle_num = isset($_GET['vehicle_num']) ? htmlspecialchars($_GET['vehicle_num'], ENT_QUOTES, 'UTF-8') : '';
$name = isset($_GET['name']) ? htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8') : '';


include 'db_conn.php';

if ($vehicle_num) {
    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT wheel_type, engine_capacity, model_year, listed_price, seating_capacity FROM rc WHERE vehicle_num = ?");
    $stmt->bind_param("s", $vehicle_num);

    // Execute the statement
    $stmt->execute();

    // Bind the result variables
    $stmt->bind_result($wheel_type, $engine_capacity, $model_year, $listed_price, $seating_capacity);

    // Fetch the result
    if ($stmt->fetch()) {
        // Variables are now populated with the database values
    } else {
        echo "No details found for vehicle number: " . htmlspecialchars($vehicle_num);
        exit;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Vehicle number not provided.";
    exit;
}

// Close the database connection
$conn->close();

// Output or use $name and $date as needed
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motor Insurance</title>
    <link rel=" shortcut icon" type="x-icon" href="logo.png">

    <!-- Styles omitted for brevity -->
</head>
<style>
        .addon { display: none; }
        /* General styles */
body {

    background: url('building11.jpg') no-repeat center center fixed; 
    background-size: cover;
    z-index: -1;
    
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
}

/* Main section styles */
main {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Dropdown menu styles */
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

/* Addon section styles */
.addon {
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 10px;
    background-color: #f9f9f9;
}

.addon h2 {
    margin: 0 0 10px;
    font-size: 20px;
    color: #0056b3;
}

.addon p {
    margin: 0 0 10px;
    font-size: 14px;
    color: #666;
}

.addon label {
    display: flex;
    align-items: center;
}

.addon input[type="checkbox"] {
    margin-right: 10px;
}
.policy-table{
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .policy-table th, .policy-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .policy-table th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .policy-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .policy-table tr:hover {
            background-color: #ddd;
        }

        .policy-table th {
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: #839ee2;
            color: black;
        }

/* Finalize button styles */
footer {
    text-align: center;
    padding: 20px;
    background-color: #fff;
    border-top: 1px solid #ddd;
}

button.finalize {
    padding: 10px 20px;
    font-size: 24px;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button.finalize:hover {
    background-color: #0056b3;
}

/* Responsive styles */
@media (max-width: 600px) {
    main {
        padding: 10px;
    }

    select {
        font-size: 14px;
    }

    .addon h2 {
        font-size: 18px;
    }

    .addon p {
        font-size: 12px;
    }

    button.finalize {
        font-size: 14px;
    }
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
                width : 72%;
                height: 130%;
            }
        }

        @media (max-width: 1920px) {
            #policyDetails{
                position: relative;
                left:10%;
                width:80%;
                
            }
        }

#policyDetails{
    border-radius:20%;
}

    </style>


<body>

<a href="new1.html" class="home-icon">
        <img src="home.jpg" alt="Home">
    </a><br><br><br><br><br><br>
    <main>
        <section>
            <h1>Add-ons for Vehicle: <?php echo htmlspecialchars($vehicle_num); ?></h1>
            <label for="insuranceType">Select Insurance Type:</label>
            <select id="insuranceType" onchange="showAddons()">
                <option value="">--Select--</option>
                <option value="thirdparty">Third-Party</option>
                <option value="owndamage">Own Damage</option>
                <option value="comprehensive">Comprehensive</option>
                <option value="others">Others</option>
            </select>
        </section>
        <section class="addon thirdparty" id="addon1">
            <h2>Roadside Assistance</h2>
            <p>Get help whenever your car breaks down, anytime and anywhere.</p>
            <label>
                <input type="checkbox" name="addon" value="Roadside Assistance" data-price="500" onchange="updatePremium()"> Select
            </label>
        </section>
        <section class="addon owndamage comprehensive" id="addon2">
            <h2>Zero Depreciation Cover</h2>
            <p>Avoid depreciation cuts during claims.</p>
            <label>
                <input type="checkbox" name="addon" value="Zero Depreciation Cover" data-price="1000" onchange="updatePremium()"> Select
            </label>
        </section>
        <section class="addon owndamage comprehensive" id="addon3">
            <h2>Engine Protection</h2>
            <p>Get coverage for any engine damages.</p>
            <label>
                <input type="checkbox" name="addon" value="Engine Protection" data-price="1500" onchange="updatePremium()"> Select
            </label>
        </section>
        <section class="addon comprehensive" id="addon4">
            <h2>Personal Accident Cover</h2>
            <p>Get personal accident cover for driver and passengers.</p>
            <label>
                <input type="checkbox" name="addon" value="Personal Accident Cover" data-price="2000" onchange="updatePremium()"> Select
            </label>
        </section>
    </main>
    <div id="policyDetails" ></div>
    <div id="actionButton"></div>
    <footer>
        <button class="finalize" onclick="finalizeSelection()">Finalize Selection</button>
    </footer>
    <script>
        // Initialize vehicle_num with the PHP value
        var vehicle_num = "<?php echo $vehicle_num; ?>";
        
        var netPremium;  
        var wheelType = <?php echo json_encode($wheel_type); ?>;
        var engineCapacity = <?php echo json_encode($engine_capacity); ?>;
        var modelYear = <?php echo json_encode($model_year); ?>;
        var listedPrice = <?php echo json_encode($listed_price); ?>;
        var seatingCapacity = <?php echo json_encode($seating_capacity); ?>;
        
        var currentYear = new Date().getFullYear();
        var vehicleAge = currentYear - modelYear;

        function calculateDepreciationRate(vehicleAge) {
            if (vehicleAge < 0.5) return 0.05;
            else if (vehicleAge < 1) return 0.15;
            else if (vehicleAge < 2) return 0.20;
            else if (vehicleAge < 3) return 0.30;
            else if (vehicleAge < 4) return 0.40;
            else if (vehicleAge < 5) return 0.50;
            else return 0.50;
        }

        var basePremium;
        var yearFactor = 0.05;
        var seatFactor = 0.02;

        switch (wheelType) {
            case 'Two wheeler':
                if (engineCapacity <= 110) basePremium = 1000;
                else if (engineCapacity <= 160) basePremium = 1500;
                else basePremium = 2000;
                break;
            case 'Three wheeler':
                if (engineCapacity <= 999) basePremium = 3000;
                else if (engineCapacity <= 1099) basePremium = 4000;
                else basePremium = 9000;
                break;
            case 'Four wheeler':
                if (engineCapacity <= 1099) basePremium = 6000;
                else if (engineCapacity <= 2020) basePremium = 11500;
                else basePremium = 15000;
                break;
            default:
                if (engineCapacity <= 2020) basePremium = 11500;
                else basePremium = 19000;
        }

        var depreciationRate = calculateDepreciationRate(vehicleAge);
        var idv = listedPrice * (1 - depreciationRate);

        function updatePremium() {
            let addonCost = 0;
            let addonRows = [];
            
            const selectedAddonsElements = document.querySelectorAll('input[name="addon"]:checked');
            
            selectedAddonsElements.forEach(checkbox => {
                const addonName = checkbox.value;
                const addonPrice = parseFloat(checkbox.getAttribute('data-price'));
                addonCost += addonPrice;
                addonRows.push(`<tr><td>${addonName}</td><td>${addonPrice}</td></tr>`);
            });
            
            netPremium = basePremium * (1 + yearFactor * vehicleAge + seatFactor * seatingCapacity) + addonCost;
            
            const insuranceDetailsHTML = `
                <table class="policy-table">
                    <tr>
                        <th>Model Year</th>
                        <td style="background-color: #ffffff; color: black;">${modelYear}</td>
                        <th>Engine Capacity</th>
                        <td style="background-color: #ffffff; color: black;">${engineCapacity}</td>
                    </tr>
                    <tr>
                        <th>Seats</th>
                        <td>${seatingCapacity}</td>
                        <th>Net Premium</th>
                        <td style="background-color: #31bf31; color: white;">${Math.round(netPremium)}</td>
                    </tr>
                    <tr>
                        <th>IDV</th>
                        <td style="background-color: #ffffff; color: black;">${Math.round(idv)}</td>
                        <th>Vehicle Age</th>
                        <td style="background-color: #ffffff; color: black;">${vehicleAge}</td>
                    </tr>
                    <tr>
                        <th>Selected Add-ons</th>
                        <td colspan="3">
                            <table class="policy-table">
                                <tr>
                                    <th>Add-on</th>
                                    <th>Cost</th>
                                </tr>
                                ${addonRows.join('')}
                            </table>
                        </td>
                    </tr>
                </table>
            `;

            document.getElementById("policyDetails").innerHTML = insuranceDetailsHTML;
        }

        function showAddons() {
            const insuranceType = document.getElementById('insuranceType').value;
            const addons = document.querySelectorAll('.addon');
            
            addons.forEach(addon => {
                addon.style.display = 'none'; // Hide all addons initially
                if (addon.classList.contains(insuranceType) || insuranceType === '') {
                    addon.style.display = 'block'; // Show only addons related to the selected insurance type
                }
            });

            updatePremium(); // Update premium based on visible add-ons
        }

        function finalizeSelection() {
            const selectedAddons = [];
            const checkboxes = document.querySelectorAll('input[name="addon"]:checked');
            
            checkboxes.forEach(checkbox => {
                selectedAddons.push(checkbox.value);
            });

            if (typeof netPremium === 'undefined' || typeof vehicle_num === 'undefined' || !vehicle_num) {
                alert('Error: netPremium or vehicle_num is not defined.');
                return;
            }

            alert('Selected add-ons: ' + selectedAddons.join(', '));
            insertToDB(Math.round(netPremium), vehicle_num, selectedAddons);
        }

        // Event listeners
        document.getElementById('insuranceType').addEventListener('change', showAddons);
        document.querySelectorAll('input[name="addon"]').forEach(checkbox => {
            checkbox.addEventListener('change', updatePremium);
        });

        function insertToDB(netPremium, vehicleNum, selectedAddons) {
            // Prepare the data to send
            const requestData = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    netPremium: Math.round(netPremium),
                    vehicle_num: vehicleNum,
                    addons: JSON.stringify(selectedAddons) // Convert array to JSON string
                })
            };

            // Send data to the server-side script
            fetch('insert_addons.php', requestData)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = `transactionnew.php?vehicle_num=${vehicle_num}&net_premium=${Math.round(netPremium)}`;
                    } else {
                        alert('Error inserting data: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred.');
                });
        }

    </script>
</body>
</html>
