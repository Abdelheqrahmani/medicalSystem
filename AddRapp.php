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
}

// Handle form submission for analyses
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ordonnanceID = $lastInsertedID;
    $typeAnalayses = $_POST['typeAnalayses'];
    $descriptions = $_POST['description'];

    try {
        $bdd->beginTransaction();

        // Prepare the insert query
        $insertQuery = $bdd->prepare("INSERT INTO analyses (OrdonnanceID, typeAnalayses, description) 
                                      VALUES (:ordonnanceID, :typeAnalayses, :description)");

        // Loop through each analysis and execute the insert query
        for ($i = 0; $i < count($typeAnalayses); $i++) {
            $insertQuery->execute([
                'ordonnanceID' => $ordonnanceID,
                'typeAnalayses' => $typeAnalayses[$i],
                'description' => $descriptions[$i]
            ]);
        }

        $bdd->commit();
        echo "Analyses added successfully!";
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
    <title>Add Analyses</title>
    <link rel="stylesheet" href="css/Bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/logo.css">
    <link rel="stylesheet" href="css/portail.css">
    <link rel="stylesheet" href="css/addOrd.css">
</head>
<body>
<div class="content">
    <h1>Add Analysis to Ordonnance #<?php echo isset($lastInsertedID) ? $lastInsertedID : ''; ?></h1>
    <form id="analysesForm" method="POST">
    <input type="hidden" name="OrdonnanceID" value="<?php echo isset($lastInsertedID) ? $lastInsertedID : ''; ?>">
    <div id="analyses">
        <div class="analysis-entry">
            <label for="typeAnalayses">Type of Analyses:</label>
            <input type="text" class="typeAnalayses" name="typeAnalayses[]" required>
            
            <label for="description">Description:</label>
            <input type="text" class="description" name="description[]" maxlength="500">
            
            <br>
            <button type="button" class="btn-delete btn" onclick="removeAnalysis(this)">Delete</button>
        </div>
    </div>
    <button type="button" class="btn btn-add" onclick="addAnalysis()">Add Analysis</button>
    <button class="btn btn-sub" type="submit">Submit</button>
</form>

</div>

<script>
function addAnalysis() {
    const analysisDiv = document.createElement('div');
    analysisDiv.classList.add('analysis-entry');
    analysisDiv.innerHTML = `
        <label for="typeAnalayses">Type of Analyses:</label>
        <input type="text" class="typeAnalayses" name="typeAnalayses[]" required>
        
        <label for="description">Description:</label>
        <input type="text" class="description" name="description[]" maxlength="500">
        
        <br>
        <button type="button" class="btn-delete btn" onclick="removeAnalysis(this)">Delete</button>
    `;
    document.getElementById('analyses').appendChild(analysisDiv);
}

function removeAnalysis(button) {
    button.parentElement.remove();
}
</script>
</body>
</html>
