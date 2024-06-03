<?php
// form.php

session_start();
if(!isset($_SESSION['id'])) { 
    header('Location:index.html');
    exit;
}

include("connect.php");
$medcinID = $_SESSION['id'];

if (isset($_GET['patientID'])) {
    $patientID = $_GET['patientID'];
} else {
    // Handle the case when patientID is not provided in the URL
}

if (isset($patientID)) {
    echo $patientID;
} else {
    echo "Patient ID is not provided.";
}

// Create a new ordonnance


    // Prepare the insert query
    $insertQuery = $bdd->prepare("INSERT INTO ordonnance (PatientID, MedcinID, Date, Type) 
                                  VALUES (:patientID, :medcinID, NOW(), 'Type')");

    // Execute the query
    $register = $insertQuery->execute([
        'patientID' => $patientID,
        'medcinID' => $medcinID
    ]);
    if ($register) {
        $lastInsertedID = $bdd->lastInsertId();
        echo "Last inserted ID: $lastInsertedID";
    } else {
        echo "Insert failed!";
    }
?>



<!DOCTYPE html>
<html>
<head>
    <title>Add Medicament</title>

</head>
<body>
    <h1>Add Medicament to Ordonnance #<?php echo $ordonnanceID; ?></h1>
    <form id="medicamentForm">
        <label for="MedicamentID">Medicament ID:</label>
        <select id="MedicamentID" name="MedicamentID" required>
            <?php
            // Retrieve the medicament data from the database

            // Loop through the results and create an option for each medicament
            while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['MedicamentID'] . "'>" . $row['Name'] . "</option>";
            }
            ?>
        </select><br>
        <label for="Quantity">Quantity:</label>
        <input type="number" id="Quantity" name="Quantity" required><br>
        <button type="button" onclick="addMedicament()">Add Medicament</button>
    </form>
    <div id="result"></div>
</body>
</html>
