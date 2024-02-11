<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Product Status</h2>

        <?php
        // Database connection
        $servername = "localhost";
        $username = "root"; // Enter your MySQL username
        $password = ""; // Enter your MySQL password
        $dbname = "product"; // Enter your database name
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve form data from database
        $sql = "SELECT * FROM product_status_data";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display form data in separate sections based on product_received value
            $received_yes = [];
            $received_no = [];

            while ($row = $result->fetch_assoc()) {
                if ($row['product_received'] === 'Yes') {
                    $received_yes[] = $row;
                } else {
                    $received_no[] = $row;
                }
            }

            // Display data for "Yes" category
            if (!empty($received_yes)) {
                echo "<h3>Product Received - Yes</h3>";
                echo "<table>";
                echo "<tr><th>Ration Card Holder Name</th><th>Phone Number</th></tr>";
                foreach ($received_yes as $data) {
                    echo "<tr><td>{$data['name']}</td><td>{$data['phone']}</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No data available for 'Product Received - Yes'.</p>";
            }

            // Display data for "No" category
            if (!empty($received_no)) {
                echo "<h3>Product Received - No</h3>";
                echo "<table>";
                echo "<tr><th>Ration Card Holder Name</th><th>Phone Number</th></tr>";
                foreach ($received_no as $data) {
                    echo "<tr><td>{$data['name']}</td><td>{$data['phone']}</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No data available for 'Product Received - No'.</p>";
            }
        } else {
            echo "<p>No data available.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
