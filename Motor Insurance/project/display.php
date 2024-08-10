<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motor Insurance</title>
    <link rel=" shortcut icon" type="x-icon" href="logo.png">
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <style>
        body {
            background-image: linear-gradient(to right,#F8F8FF ,#E6E6FA);
            font-family: Arial, sans-serif;
            background-size: cover;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            position: relative;
        }

        .content-wrapper {
            position: relative;
            margin: auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            max-width: 800px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1;
            animation: fadeIn 3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            background: linear-gradient(to bottom, #336699 0%, #339966 100%);
            color: white;
            padding: 10px 0;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
            animation: gradient 3s ease infinite;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .button {
            position: absolute;
            top: 91%;
            left: 15%;
            background-color: #b3b3cc;
            border: 2px solid;
            border-radius: 50px;
            font-size: 16px;
            color: #000;
            padding: 10px;
            width: 170px;
            text-align: center;
            transition: background 0.4s, border-radius 0.4s;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            text-decoration: none;
        }

        .button:hover {
            background: linear-gradient(to bottom, #336699 0%, #33cccc 100%);
            border-radius: 20px;
        }

        .but {
            position: absolute;
            top: 91%;
            left: 60%;
            background-color: #b3b3cc;
            border: 2px solid;
            border-radius: 50px;
            font-size: 16px;
            color: #000;
            padding: 10px;
            width: 170px;
            text-align: center;
            transition: background 0.4s, border-radius 0.4s;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            text-decoration: none;
        }

        .but:hover {
            background: linear-gradient(to bottom, #336699 0%, #33cccc 100%);
            border-radius: 20px;
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

        .img1 {
            position: absolute;
            top: 91.5%;
            left: 43%;
            height: 5%;
            width: 11%;
        }


	.download-button {
            position: fixed;
            top: 8%;
            right: 2%;
            z-index: 10;
            padding: 10px 20px;
            background-color: #27AE60;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .download-button:hover {
            background-color: #219150;
        }

        @media (max-width: 768px) {
            .home-icon {
                z-index: 10;
                top: 4%;
                left: 4%;
            }

            .home-icon img {
                width: 50px;
                height: 50px;
            }

            .button, .but {
                width: 140px;
                font-size: 14px;
            }

            .img1 {
                left: 47%;
                height: 6%;
                width: 10%;
            }
        }

        @media (max-width: 480px) {
            h2 {
                font-size: 18px;
                padding: 8px 0;
            }

            th, td {
                padding: 8px;
            }

            .button, .but {
                width: 77px;
                font-size: 13px;
            }

            .img1 {
                left: 42%;
                height: 5%;
                width: 16%;
            }
            .download-button{
                top: 5%;
                right: 3%;
            }
        }

      
    </style>
</head>

    <body>
        
        
        <a href="new1.html" class="home-icon">
            <img src="home.jpg" alt="Home">
        </a>
        <button class="download-button" onclick="downloadInsuranceCopy()">Download Insurance Copy</button>
        <br><br><br><br>
        <div class="content-wrapper">
        
        <?php
                $name = '';
                $vehicle_num = '';

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $name = $_POST['name'];
                    $vehicle_num = $_POST['vehicle_num'];
                } elseif (isset($_GET['name']) && isset($_GET['vehicle_num'])) {
                    $name = $_GET['name'];
                    $vehicle_num = $_GET['vehicle_num'];
                }
                if (!empty($name) && !empty($vehicle_num)) {
                $servername = "localhost";
                $username = "root";
                $password = "XXXXX";
                $dbname = "customer";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql_customer = "SELECT * FROM customer WHERE cname = '$name'";
                $result_customer = $conn->query($sql_customer);

                $sql_rc = "SELECT * FROM rc WHERE name = '$name' AND vehicle_num = '$vehicle_num'";
                $result_rc = $conn->query($sql_rc);

                $sql_afteraddons = "SELECT * FROM afteraddons WHERE vehicle_num = '$vehicle_num'";
                $result_afteraddons = $conn->query($sql_afteraddons);

                if ($result_customer->num_rows > 0 && $result_rc->num_rows > 0) {
                    $customer = $result_customer->fetch_assoc();
                    $rc = $result_rc->fetch_assoc();

                    echo "<h2>CUSTOMER DETAILS</h2>";
                    echo "<table>
                            <tr><th>Customer ID</th><td>{$customer['cid']}</td></tr>
                            <tr><th>Name</th><td>{$customer['cname']}</td></tr>
                            <tr><th>Date of Birth</th><td>{$customer['cdob']}</td></tr>
                            <tr><th>Phone Number</th><td>{$customer['cphone_no']}</td></tr>
                            <tr><th>Email</th><td>{$customer['cemail']}</td></tr>
                                <tr><th>License Number</th><td>{$customer['clicense']}</td></tr>
                            <tr><th>Address</th><td>{$customer['caddress']}</td></tr>
                        </table>";

                    echo "<h2>RC DETAILS</h2>";
                    echo "<table>
                            <tr><th>Name</th><td>{$rc['name']}</td></tr>
                            <tr><th>Vehicle Number</th><td>{$rc['vehicle_num']}</td></tr>
                            <tr><th>Registration Date</th><td>{$rc['registration_date']}</td></tr>
                            <tr><th>Chasis Number</th><td>{$rc['chasi_number']}</td></tr>
                            <tr><th>Engine Number</th><td>{$rc['engine_number']}</td></tr>
                            <tr><th>Wheel Type</th><td>{$rc['wheel_type']}</td></tr>
                            <tr><th>Fuel Type</th><td>{$rc['fuel_type']}</td></tr>
                            <tr><th>Model Year</th><td>{$rc['model_year']}</td></tr>
                            <tr><th>Seating Capacity</th><td>{$rc['seating_capacity']}</td></tr>
                            <tr><th>Engine Capacity</th><td>{$rc['engine_capacity']}</td></tr>
                            <tr><th>Listed Price</th><td>{$rc['listed_price']}</td></tr>
                            <tr><th>Usage Type</th><td>{$rc['usage_type']}</td></tr>
                            <tr><th>Fitness Valid Upto</th><td>{$rc['fitness_validupto']}</td></tr>
                        </table>";



                        if ($result_afteraddons->num_rows > 0) {
                            $afteraddons = $result_afteraddons->fetch_assoc();
                            
                            
                            $dateFormat = 'Y-m-d H:i:s';
                            $currentDateTime = date($dateFormat);

                            
                        
                            echo "<br><br><h2>ADD-ONS DETAILS</h2><br>";
                            echo "<table>
                                    <tr><th>Vehicle Number</th><td>{$afteraddons['vehicle_num']}</td></tr>
                                    <tr><th>Net Premium</th><td>{$afteraddons['netPremium']}</td></tr>
                                    <tr><th>Add-ons</th><td>{$afteraddons['addons']}</td></tr>
                                    <tr><th>Insured On </th><td>{$afteraddons['date_added']}</td></tr>
                                    <tr><th>Insurance Valid Upto</th><td>{$afteraddons['due_date']}</td></tr>
                                    </table>";
        
                          
                        }
            
                        
                        $price=$afteraddons['netPremium'];
                        $renewInsuranceUrl = 'transact.php?variable1=' . urlencode($name) . '&variable2=' . urlencode($vehicle_num) . '&variable3=' . urlencode($price);
                        

                        echo '<a href="#" data-url="' . htmlspecialchars($renewInsuranceUrl, ENT_QUOTES, 'UTF-8') . '" class="button" id="renewInsuranceButton">
                                RENEW<br>INSURANCE
                                </a>';                    


                    echo '<a href="claim.php?name=' . urlencode($name) . 
                        '&vehicle_num=' . urlencode($vehicle_num) . '" class="but" >CLAIM<br>INSURANCE</a>';

                    echo '<img src="front_bike.png" class="img1" >';
                } else {
                    echo "<p>No records found for the provided name and vehicle number.</p>";
                }

                // $conn->close();
            }
            ?><br><br><br><br><br><br><br><br>
        </div><br><br><br><br>
    </body>


                    


                       


<script>
   

    document.getElementById('renewInsuranceButton').addEventListener('click', function() {
        var due_date = new Date("<?php echo $afteraddons['due_date']; ?>");
        var curr_date = new Date("<?php echo $currentDateTime; ?>");
        var url = this.getAttribute('data-url');

        // Compare the dates
        if (due_date < curr_date) {
            
            window.location.href = url;
            
        } else {
            alert("Current Insurance is on Progress");
        }
    });


function downloadInsuranceCopy() {
    // Create a new container element to hold the content
    const container = document.createElement('div');

    // Create a header for the company logo and name
    const header = document.createElement('div');
    header.style.textAlign = 'center';
    header.style.marginBottom = '20px';

    const logo = document.createElement('img');
    logo.src = 'logo.png'; // Path to your logo
    logo.style.width = '100px';
    logo.style.height = 'auto';
    logo.style.display = 'block';
    logo.style.margin = '0 auto';

    const companyName = document.createElement('h1');
    companyName.innerText = 'MOTOR INSURANCE';
    companyName.style.fontSize = '24px';
    companyName.style.margin = '10px 0';

    // Append logo and company name to the header
    header.appendChild(logo);
    header.appendChild(companyName);

    // Create a footer with date and time
    const footer = document.createElement('div');
    footer.style.position = 'absolute';
    footer.style.bottom = '0';
    footer.style.width = '100%';
    footer.style.textAlign = 'center';
    footer.style.fontSize = '12px';
    footer.style.borderTop = '1px solid #ccc';
    footer.style.padding = '10px 0';
    footer.style.marginTop = '20px';

    const currentDate = new Date().toLocaleString();

    footer.innerText = `© 2024 Motor Insurance. All rights reserved.\n\nDate and Time of Download: ${currentDate}`;


    // Append header, content, and footer to the container
    container.appendChild(header);
    container.innerHTML += document.querySelector('.content-wrapper').innerHTML;
    container.appendChild(footer);

    document.body.appendChild(container);

    // Hide elements that should not appear in the PDF
    const elementsToHide = document.querySelectorAll('.download-button, .button, .but, .img1');
    elementsToHide.forEach(el => el.style.visibility = 'hidden');

    // Define options for html2pdf
    const opt = {
        margin:       [0.5, 0.5, 1, 0.5], // top, right, bottom, left
        filename:     'Insurance_Copy.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2, logging: true }, // Enable logging for debugging
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

    // Use html2pdf to generate and save the PDF
    html2pdf().set(opt).from(container).save().then(() => {
        // Restore visibility of hidden elements
        elementsToHide.forEach(el => el.style.visibility = '');

        // Remove the temporary container
        document.body.removeChild(container);
    }).catch(err => {
        console.error('Error generating PDF:', err);
    });
}






$(document).ready(function(){
  $(".but").hover(function(){
    $(".img1").attr("src", "side1_bike.png");
  }, function(){
    $(".img1").attr("src", "front_bike.png");
  });
});

$(document).ready(function(){
    $(".button").hover(function(){
        $(".img1").attr("src", "side2_bike.png");
    }, function(){
        $(".img1").attr("src", "front_bike.png");
    });
});





</script>


</html>
