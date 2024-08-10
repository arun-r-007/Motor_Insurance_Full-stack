<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motor Insurance</title>
    <link rel="shortcut icon" type="image/x-icon" href="logo.png">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #f7f7f7;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding: 20px;
        }
        
        h2 {
            font-size: 26px;
            margin: 20px 0;
            text-align: center;
            color: #2C3E50;
        }
        .filter-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .filter-container label {
            margin-right: 10px;
            font-size: 16px;
            color: #2C3E50;
        }
        .filter-container select,
        .filter-container input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #ffffff;
            color: #333;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            margin-left: 10px;
        }
        .filter-container select:focus,
        .filter-container input[type="text"]:focus {
            border-color: #3498DB;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.3);
            outline: none;
        }
        .responsive-table {
            list-style-type: none;
            padding: 0;
        }
        .table-header {
            background-color: #2C3E50;
            color: #ffffff;
            display: flex;
            justify-content: space-between;
            padding: 15px 30px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .table-row {
            background-color: #ffffff;
            box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            padding: 15px 30px;
            margin-bottom: 10px;
            transition: transform 0.3s ease;
        }
        .table-row:hover {
            transform: scale(1.02);
        }
        .col-1 {
            flex-basis: 20%;
        }
        .col-2 {
            flex-basis: 20%;
        }
        .col-3 {
            flex-basis: 20%;
        }
        .col-4 {
            flex-basis: 20%;
        }
        .col-5 {
            flex-basis: 20%;
        }
        .col-6 {
            flex-basis: 20%;
        }
        .status-button {
            background-color: #3498DB;
            color: #ffffff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        .status-button:hover {
            background-color: #2980B9;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }
        .status-button.renewal {
            background-color: #E74C3C;
        }
        .status-button.renewal:hover {
            background-color: #C0392B;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }
        .status-button.active {
            animation: glow 1.5s infinite;
        }
        .chart-button {
            display: block;
            margin: 20px auto;
            background-color: #8E44AD;
            color: #ffffff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            font-size: 16px;
        }
        .chart-button:hover {
            background-color: #71368A;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }
        @keyframes glow {
            0% {
                box-shadow: 0 0 5px #3498DB;
            }
            50% {
                box-shadow: 0 0 20px #3498DB;
            }
            100% {
                box-shadow: 0 0 5px #3498DB;
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
                width : 82%;
                height: 130%;
            }
            
        }

        @media all and (max-width: 767px) {
            .table-header {
                display: none;
            }
            .table-row {
                flex-direction: column;
                align-items: flex-start;
                padding: 20px;
            }
            .col {
                flex-basis: 100%;
                padding: 10px 0;
            }
            .col:before {
                color: #6C7A89;
                padding-right: 10px;
                content: attr(data-label);
                flex-basis: 50%;
                text-align: right;
            }
        }
    </style>
</head>
<?php
$name='XXXXX';                                                  //  USER NAME and PASSWORD
$password='XXXXX';
?>
<body>
    <a href="first.html" class="home-icon">
        <img src="home.jpg" alt="Home">
    </a>
    <a href="disppay.php?name=<?php echo urlencode($name);?>&password=<?php echo urlencode($password);?>" class="back-icon">
        <img src="left-arrow.png" class="back-img" alt="Back">
    </a>
<br><br><br><br><br><br>
    <div class="container">
        <h2><i>CONTACT REQUEST</i></h2><br><br><br>
        
       

        <ul class="responsive-table" id="paymentTable">
            <li class="table-header">
                <div class="col col-1">Name</div>
                <div class="col col-2">Email</div>
                <div class="col col-3">Subject</div>
                <div class="col col-4">Message</div>
                <div class="col col-5">Date</div>
            </li>

            <?php
            // Define database credentials
            $servername = "localhost";
            $dbusername = "root";
            $dbpassword = "XXXXX";
            $dbname = "customer";

            // Check if username and password are provided
            
            // Validate credentials
            if ( 1) {
                // Create database connection
                $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch customer records
                $sql_contact_form = "SELECT name, email, subject, message, submitted_at FROM contact_form";
                $result_contact_form = $conn->query($sql_contact_form);

                // Display customer records
                if ($result_contact_form->num_rows > 0) {
                    while ($row = $result_contact_form->fetch_assoc()) {
                        echo "<li class='table-row'>
                                <div class='col col-1' data-label='Name'>" . htmlspecialchars($row['name']) . "</div>
                                <div class='col col-2' data-label='Email'>" . htmlspecialchars($row['email']) . "</div>
                                <div class='col col-3' data-label='Subject'>" . htmlspecialchars($row['subject']) . "</div>
                                <div class='col col-4' data-label='Message'>" . htmlspecialchars($row['message']) . "</div>
                                <div class='col col-5' data-label='Submitted At'>" . htmlspecialchars($row['submitted_at']) . "</div>
                            </li>";
                    }
                } else {
                    echo '<h1 style="text-align: center; color: red;">No Records Found</h1>';
                }

                // Close connection
                $conn->close();
            } else {
                echo "<script>alert('Incorrect credentials. Access denied.'); window.location.href = 'admin.html';</script>";
                exit();
            }
            ?>
        </ul>
        
        
    </div>
   
    <script>
        function filterRecords() {
            const filter = document.getElementById('filter').value;
            const rows = document.querySelectorAll('.table-row');
            const now = new Date();

            rows.forEach(row => {
                const dateCell = row.querySelector('.col-4');
                const dateAdded = new Date(dateCell.textContent);

                let showRow = true;
                if (filter === 'weekly') {
                    const oneWeekAgo = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 7);
                    showRow = dateAdded >= oneWeekAgo;
                } else if (filter === 'monthly') {
                    const oneMonthAgo = new Date(now.getFullYear(), now.getMonth() - 1, now.getDate());
                    showRow = dateAdded >= oneMonthAgo;
                }

                row.style.display = showRow ? 'flex' : 'none';
            });
        }

        function searchRecords() {
            const searchInput = document.getElementById('search').value.toLowerCase();
            const rows = document.querySelectorAll('.table-row');

            rows.forEach(row => {
                const vehicleNum = row.querySelector('.col-2').textContent.toLowerCase();
                row.style.display = vehicleNum.includes(searchInput) ? 'flex' : 'none';
            });
        }
    </script>
</body>
</html>
