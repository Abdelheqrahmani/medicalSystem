<?php
// form.php

session_start();
if (!isset($_SESSION['id'])) {
    header('Location: index.html');
    exit;
}

include("connect.php");
$medcinID = $_SESSION['id'];

if (isset($_GET['patientID'])) {
    $patientID = $_GET['patientID'];
} else {
    $patientID = null;
}

if ($patientID) {
    echo $patientID;
} else {
    echo "Patient ID is not provided.";
}

if ($patientID) {
    // Prepare the insert query for ordonnance
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
}

// Handle form submission for rapport
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ordonnanceID = $lastInsertedID;
    $rapportTitles = $_POST['rapportTitle'];
    $rapportDescriptions = $_POST['rapportDescription'];
    $rapportFiles = $_POST['rapportFile'];

    try {
        $bdd->beginTransaction();

        // Insert rapport
        $insertRapportQuery = $bdd->prepare("INSERT INTO rapport (OrdonnanceID, title, description, file) 
                                             VALUES (:ordonnanceID, :title, :description, :file)");

        for ($i = 0; $i < count($rapportTitles); $i++) {
            $insertRapportQuery->execute([
                'ordonnanceID' => $ordonnanceID,
                'title' => $rapportTitles[$i],
                'description' => $rapportDescriptions[$i],
                'file' => $rapportFiles[$i]
            ]);
        }

        $bdd->commit();
        echo "Rapports added successfully!";
    } catch (PDOException $e) {
        $bdd->rollBack();
        die("Insert failed: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Rapport</title>
    <link rel="stylesheet" href="css/Bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/logo.css">
    <link rel="stylesheet" href="css/portail.css">
    <link rel="stylesheet" href="css/addOrd.css">
</head>
<body>
<div class="content">
    <h1>Add Rapport to Ordonnance #<?php echo isset($lastInsertedID) ? $lastInsertedID : ''; ?></h1>
    <form id="rapportForm" method="POST">
        <input type="hidden" name="OrdonnanceID" value="<?php echo isset($lastInsertedID) ? $lastInsertedID : ''; ?>">
        
        <div id="rapports">
            <div class="rapport-entry">
                <label for="rapportTitle">Title:</label>
                <input type="text" class="rapportTitle" name="rapportTitle[]" required>
                
                <label for="rapportDescription">Description:</label>
                <input type="text" class="rapportDescription" name="rapportDescription[]" maxlength="500">

                <label for="rapportFile">File:</label>
                <input type="text" class="rapportFile" name="rapportFile[]" required>
                
                <br>
                <button type="button" class="btn-delete btn" onclick="removeRapport(this)">Delete</button>
            </div>
        </div>
        <button type="button" class="btn btn-add" onclick="addRapport()">Add Rapport</button>

        <button class="btn btn-sub" type="submit">Submit</button>
    </form>
</div>

<script>
function addRapport() {
    const rapportDiv = document.createElement('div');
    rapportDiv.classList.add('rapport-entry');
    rapportDiv.innerHTML = `
        <label for="rapportTitle">Title:</label>
        <input type="text" class="rapportTitle" name="rapportTitle[]" required>
        
        <label for="rapportDescription">Description:</label>
        <input type="text" class="rapportDescription" name="rapportDescription[]" maxlength="500">

        <label for="rapportFile">File:</label>
        <input type="text" class="rapportFile" name="rapportFile[]" required>
        
        <br>
        <button type="button" class="btn-delete btn" onclick="removeRapport(this)">Delete</button>
    `;
    document.getElementById('rapports').appendChild(rapportDiv);
}

function removeRapport(button) {
    button.parentElement.remove();
}
</script>
</body>
</html>
