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

// Create a new ordonnance if patientID is provided
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

// Get all medicaments
try {
    $query = $bdd->prepare("SELECT * FROM medicament");
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ordonnanceID = $_POST['OrdonnanceID'];
    $medicamentIDs = $_POST['MedicamentID'];
    $quantities = $_POST['Quantity'];

    try {
        $bdd->beginTransaction();

        // Prepare the insert query
        $insertQuery = $bdd->prepare("INSERT INTO ordonnancemedicament (OrdonnanceID, MedicamentID, Quantity, description) 
                                      VALUES (:ordonnanceID, :medicamentID, :quantity, 'description')");

        // Loop through each medicament and execute the insert query
        for ($i = 0; $i < count($medicamentIDs); $i++) {
            $insertQuery->execute([
                'ordonnanceID' => $ordonnanceID,
                'medicamentID' => $medicamentIDs[$i],
                'quantity' => $quantities[$i]
            ]);
        }

        $bdd->commit();
        echo "Medicaments added successfully!";
    } catch (PDOException $e) {
        $bdd->rollBack();
        die("Insert failed: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Medicament</title>
    <link rel="stylesheet" href="css/Bootstrap.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/index.css">

		<link rel="stylesheet" href="css/logo.css">
		<link rel="stylesheet" href="css/portail.css">
		<link rel="stylesheet" href="css/addOrd.css">
</head>
<body>
    <div class="content">
    <h1>Add Medicament to Ordonnance #<?php echo isset($lastInsertedID) ? $lastInsertedID : ''; ?></h1>
    <form id="medicamentForm" method="POST">
        <input type="hidden" name="OrdonnanceID" value="<?php echo isset($lastInsertedID) ? $lastInsertedID : ''; ?>">
        <div id="medicaments">
            <div class="medicament-entry">
                <label for="MedicamentID">Medicament ID:</label>
                <select class="MedicamentID" name="MedicamentID[]" required>
                    <?php
                    if (!empty($row)) {
                        foreach ($row as $medicament) {
                            echo "<option value='" . $medicament['MedicamentID'] . "'>" . $medicament['Name'] . "</option>";
                        }
                    }
                    ?>
                </select><br>
                <label for="Quantity">Quantity:</label>
                <input type="number" class="Quantity" name="Quantity[]" required>
                <label for="Description">Description:</label>
                <input type="text" class="Description" name="Description[]" maxlength="500">
                
                <br>
                <button type="button"  class="btn-delete btn"onclick="removeMedicament(this)">   Delete</button>
            </div>
        </div>
        <button type="button" class="btn btn-add" onclick="addMedicament()">Add Medicament</button>
        <button class="btn btn-sub" type="submit">Submit</button>
    </form>

</div>

    <script>
    function addMedicament() {
        const medicamentsDiv = document.getElementById('medicaments');
        const newMedicamentEntry = document.createElement('div');
        newMedicamentEntry.className = 'medicament-entry';

        newMedicamentEntry.innerHTML = `
            <label for="MedicamentID">Medicament ID:</label>
            <select class="MedicamentID" name="MedicamentID[]" required>
                <?php
                if (!empty($row)) {
                    foreach ($row as $medicament) {
                        echo "<option value='" . $medicament['MedicamentID'] . "'>" . $medicament['Name'] . "</option>";
                    }
                }
                ?>
            </select><br>
            <label for="Quantity">Quantity:</label>
            
            <input type="number" class="Quantity" name="Quantity[]" required>
            <label for="Description">Description:</label>
            <input type="text" class="Description" name="Description[]" maxlength="500"><br>
            <button type="button"class="btn-delete btn" onclick="removeMedicament(this)">Delete</button>
        `;

        medicamentsDiv.appendChild(newMedicamentEntry);
    }

    function removeMedicament(button) {
        const medicamentEntry = button.parentElement;
        medicamentEntry.remove();
    }
    </script>
</body>
</html>
