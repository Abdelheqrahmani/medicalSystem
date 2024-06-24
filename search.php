<?php 
session_start();

if (!isset($_SESSION['id'])) { 
    header('Location: index.html');
    exit;
}

include("connect.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .pharmacy-list {
            list-style-type: none;
            padding: 0;
        }
        .pharmacy-item {
            background-color: #e2e2e2;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .pharmacy-item h2 {
            margin: 0;
            color: #007BFF;
        }
        .pharmacy-item p {
            margin: 5px 0;
        }
        .pharmacy-item a {
            color: #007BFF;
            text-decoration: none;
        }
        .pharmacy-item a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pharmacy Search Results</h1>
        <?php
        if (isset($_POST['data'])) {
            $data = htmlspecialchars($_POST['data'], ENT_QUOTES, 'UTF-8'); 
            echo "<p>Data received: " . $data . "</p>";

            // Prepare and execute the SQL query using PDO
            $stmt = $bdd->prepare("SELECT * FROM pharmacie WHERE Name LIKE :name");
            $searchTerm = $data . '%'; // This will match names starting with the given data
            $stmt->bindParam(':name', $searchTerm, PDO::PARAM_STR);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Check if there are any results
            if ($result) {
                echo '<ul class="pharmacy-list">';
                // Output data of each row
                foreach ($result as $row) {
                    $address = htmlspecialchars($row["Address"]);
                    $mapUrl = "https://maps.app.goo.gl/wUeCbAexhZ3MpoXc8?q=" . urlencode($address);
                    echo '<li class="pharmacy-item">';
                    echo '<h2>' . htmlspecialchars($row["Name"]) . '</h2>';
                    echo '<p>PharmacieID: ' . htmlspecialchars($row["PharmacieID"]) . '</p>';
                    echo '<p>Address: <a href="' . $mapUrl . '" target="_blank">' . $address . '</a></p>';
                    echo '<p>PhoneNumber: ' . htmlspecialchars($row["PhoneNumber"]) . '</p>';
                    echo '<p>Email: ' . htmlspecialchars($row["Email"]) . '</p>';
                    echo '</li>';
                }
                echo '</ul>';
            } else {
                echo "<p>No pharmacies found.</p>";
            }
        } else {
            echo "<p>No data received.</p>";
        }
        ?>
    </div>
</body>
</html>
