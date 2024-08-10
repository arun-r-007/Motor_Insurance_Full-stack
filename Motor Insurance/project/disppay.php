<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motor Insurance</title>
    <link rel=" shortcut icon" type="x-icon" href="logo.png">
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
<body>
    <a href="first.html" class="home-icon">
        <img src="home.jpg" alt="Home">
    </a>
    <a href="admin.html" class="back-icon">
        <img src="left-arrow.png" class="back-img" alt="Back">
    </a>

    <div class="container">
        <h2><i><br><br>CUSTOMER RECORDS</i></h2>
        
        <div class="filter-container">
            <div>
                <label for="filter">Filter by:</label>
                <select id="filter" onchange="filterRecords()">
                    <option value="all">All</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                </select>
            </div>
            <div>
                <label for="search">Search by Vehicle Number:</label>
                <input type="text" id="search" onkeyup="searchRecords()" placeholder="Enter vehicle number...">
            </div>
        </div>

        <ul class="responsive-table" id="paymentTable">
            <li class="table-header">
                <div class="col col-1">Name</div>
                <div class="col col-2">Vehicle Number</div>
                <div class="col col-3">Net Premium</div>
                <div class="col col-4">Date Added</div>
                <div class="col col-5">Status</div>
                <div class="col col-6">Addons</div>
            </li>

            <?php
            $username = '';
            $password = '';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST['name'];
                $password = $_POST['password'];
            } elseif (isset($_GET['name']) && isset($_GET['password'])) {
                $username = $_GET['name'];
                $password = $_GET['password'];
            }

            if (!empty($username) && !empty($password)) {
                if ($username !== 'XXXXX' || $password !== 'XXXXX') {                                               // USER NAME and PASSWORD
                    echo "<script>alert('Incorrect credentials. Access denied.'); window.location.href = 'admin.html';</script>";
                    exit;
                }

                $servername = "localhost";
                $dbusername = "root";
                $dbpassword = "XXXXX";
                $dbname = "customer";

                $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Modified SQL query to join `afteraddons` and `rc`
                $sql = "SELECT r.name, a.vehicle_num, a.netPremium, a.date_added, a.addons
                        FROM afteraddons a
                        JOIN rc r ON a.vehicle_num = r.vehicle_num";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $dateAdded = new DateTime($row['date_added']);
                        $currentDate = new DateTime();
                        $interval = $currentDate->diff($dateAdded);
                        $yearsDifference = $interval->y;

                        $buttonLabel = ($yearsDifference < 1) ? 'Active' : 'Inactive';
                        $buttonClass = ($yearsDifference < 1) ? 'status-button active' : 'status-button renewal';

                        $addonsString = htmlspecialchars($row['addons']); // Convert to a safe string format

                        echo "<li class='table-row'>
                                <div class='col col-1' data-label='Name'>" . $row['name'] . "</div>
                                <div class='col col-2' data-label='Vehicle Number'>" . $row['vehicle_num'] . "</div>
                                <div class='col col-3' data-label='Net Premium'>" . $row['netPremium'] . "</div>
                                <div class='col col-4' data-label='Date Added'>" . $row['date_added'] . "</div>
                                <div class='col col-5' data-label='Status'>
                                    <button class='$buttonClass'>$buttonLabel</button>
                                </div>
                                <div class='col col-6' data-label='Addons'>" . $addonsString . "</div>
                            </li>";
                    }
                    
                } else {
                    echo '<h1 style="text-align: center; color: red;">No Records Found</h1>';
                }

                $conn->close();
            } else {
                header("Location: admin.html");
                exit();
            }
            ?>
        </ul>
        <br><br><br><br>
        <button class="chart-button" onclick="window.location.href='chart.php'">View Graph</button>

        <button class="chart-button request" onclick="window.location.href='vcr.php'">View Claim Request</button>

        <button class="chart-button crequest" onclick="window.location.href='vcr1.php'">View Contact Request</button><br><br><br>
    </div>
   
   
</body>


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


</html>
