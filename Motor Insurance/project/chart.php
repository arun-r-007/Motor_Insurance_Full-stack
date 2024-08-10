<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Motor Insurance</title>
<link rel=" shortcut icon" type="x-icon" href="logo.png">

    <style>
         body {
            font-family: 'Lato', sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #2C3E50;
            margin-bottom: 20px;
        }
        #incomeChart, #customersChart {
            width: 100%;
            height: 400px;
            margin-bottom: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            background: #fff;
        }
        canvas {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .glow {
            animation: glow 1.5s infinite;
        }
        @keyframes glow {
            0% {
                box-shadow: 0 0 5px rgba(52, 152, 219, 0.8);
            }
            50% {
                box-shadow: 0 0 20px rgba(52, 152, 219, 1);
            }
            100% {
                box-shadow: 0 0 5px rgba(52, 152, 219, 0.8);
            }
        }
        .chart-title {
            text-align: center;
            font-size: 35px;
            margin-bottom: 20px;
        }
        .chart-income-title {
            color: #3498DB;
        }
        .chart-customers-title {
            color: #2ECC71;
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
</head>
<body>
<?php
$name='XXXXX';
$password='XXXXX';
?>
<a href="first.html" class="home-icon">
        <img src="home.jpg" alt="Home">
    </a>
    <a href="disppay.php?name=<?php echo urlencode($name);?>&password=<?php echo urlencode($password);?>" class="back-icon">
        <img src="left-arrow.png" class="back-img" alt="Back">
    </a>

    <div class="container">
        <h1 class="chart-title chart-income-title">Daily Income</h1><br>
        <canvas id="incomeChart" class="glow"></canvas><br><br>
        <h1 class="chart-title chart-customers-title">Number of Customers</h1><br>
        <canvas id="customersChart" class="glow"></canvas>
    </div>

    <?php
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "XXXXX";
    $dbname = "customer";

    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to get total income per day
    $sql_income = "SELECT DATE(date_added) as date, SUM(netPremium) as total_income 
                   FROM afteraddons 
                   GROUP BY DATE(date_added)
                   ORDER BY DATE(date_added) ASC";
    $result_income = $conn->query($sql_income);

    $dates_income = [];
    $incomes = [];

    if ($result_income->num_rows > 0) {
        while ($row = $result_income->fetch_assoc()) {
            $dates_income[] = $row['date'];
            $incomes[] = $row['total_income'];
        }
    }

    // Query to get number of customers per day
    $sql_customers = "SELECT DATE(date_added) as date, COUNT(*) as number_of_customers 
                      FROM afteraddons 
                      GROUP BY DATE(date_added)
                      ORDER BY DATE(date_added) ASC";
    $result_customers = $conn->query($sql_customers);

    $dates_customers = [];
    $customers = [];

    if ($result_customers->num_rows > 0) {
        while ($row = $result_customers->fetch_assoc()) {
            $dates_customers[] = $row['date'];
            $customers[] = $row['number_of_customers'];
        }
    }

    $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Fetch data from PHP
        const datesIncome = <?php echo json_encode($dates_income); ?>;
        const incomes = <?php echo json_encode($incomes); ?>;
        const datesCustomers = <?php echo json_encode($dates_customers); ?>;
        const customers = <?php echo json_encode($customers); ?>;

        // Set up the income chart
        const ctxIncome = document.getElementById('incomeChart').getContext('2d');
        new Chart(ctxIncome, {
            type: 'line',
            data: {
                labels: datesIncome,
                datasets: [{
                    label: 'Daily Income',
                    data: incomes,
                    borderColor: '#3498DB',
                    backgroundColor: 'rgba(52, 152, 219, 0.2)',
                    fill: true,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Income'
                        }
                    }
                }
            }
        });

        // Set up the customers chart
        const ctxCustomers = document.getElementById('customersChart').getContext('2d');
        new Chart(ctxCustomers, {
            type: 'bar',
            data: {
                labels: datesCustomers,
                datasets: [{
                    label: 'Number of Customers',
                    data: customers,
                    backgroundColor: '#2ECC71',
                    borderColor: '#27AE60',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Number of Customers'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>