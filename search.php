<?php 
session_start();

if (!isset($_SESSION['id'])) { 
    header('Location: index.html');
    exit;
}

include("connect.php"); 

if (isset($_POST['data'])) {
    $data = htmlspecialchars($_POST['data'], ENT_QUOTES, 'UTF-8'); 
    echo "Data received: " . $data . "<br>";

    // Prepare and execute the SQL query using PDO
    $stmt = $bdd->prepare("SELECT * FROM pharmacie WHERE Name LIKE :name");
    $searchTerm = $data . '%'; // This will match names starting with the given data
    $stmt->bindParam(':name', $searchTerm, PDO::PARAM_STR);

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if there are any results
    if ($result) {
        // Output data of each row
        foreach ($result as $row) {
            echo "PharmacieID: " . htmlspecialchars($row["PharmacieID"]) . " - Name: " . htmlspecialchars($row["Name"]) . " - Address: " . htmlspecialchars($row["Address"]) . " - PhoneNumber: " . htmlspecialchars($row["PhoneNumber"]) . " - Email: " . htmlspecialchars($row["Email"]) . "<br>";
        }
    } else {
        echo "No pharmacies found.";
    }
} else {
    echo "No data received.";
}
?>
