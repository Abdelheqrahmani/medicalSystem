<?php
// Start the session
session_start();

// Include the database connection file
include("connect.php");

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the 'id' parameter from the URL
    $ordonnanceID = $_GET['id'];

    // Sanitize the 'id' parameter to prevent SQL injection
    $ordonnanceID = filter_var($ordonnanceID, FILTER_SANITIZE_NUMBER_INT);

    // Prepare the SQL query to fetch details of the specified ordonnance
    $stmt = $bdd->prepare("SELECT * FROM Ordonnance WHERE OrdonnanceID = :ordonnanceID");
    $stmt->execute(['ordonnanceID' => $ordonnanceID]);
    $ordonnance = $stmt->fetch();

    if ($ordonnance) {
        // Fetch associated medicaments
        $medicamentQuery = $bdd->prepare("
            SELECT * from analyses
            WHERE analyses.OrdonnanceID = :ordonnanceID
        ");
        $medicamentQuery->execute(['ordonnanceID' => $ordonnanceID]);
        $medicaments = $medicamentQuery->fetchAll();
    } else {
        echo "No ordonnance found with the specified ID.";
        exit;
    }
} else {
    echo "No ordonnance ID specified.";
    exit;
}
?>

<!doctype html>
<html>
<head>
    <title>Ordonnance Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/Bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/logo.css">
    <link rel="stylesheet" href="css/portail.css">
    <link rel="stylesheet" href="css/medcin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header class="header">
        <a href="#" class="logo"> <i class="fas fa-heartbeat"></i> Sihati Tadj</a>
        <nav class="navbar">
            <a href="#home">Account Information</a>
            <a href="#home">Ordannances</a>
            <a href="deconnexion.php"> log out <i class="fas fa-sign-out-alt"></i></a>
        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </header>

    <div class="content">
        <h1>Ordonnance Details</h1>
        <h2>Numero d'ordannance : <?php echo htmlspecialchars($ordonnance['OrdonnanceID']); ?></h2>
        <h3>Patient ID: <?php echo htmlspecialchars($ordonnance['PatientID']); ?></h3>
        <h3>Medcin ID: <?php echo htmlspecialchars($ordonnance['MedcinID']); ?></h3>
        <h3>Date: <?php echo htmlspecialchars($ordonnance['Date']); ?></h3>
        <h2>Medicaments</h2>
        <table class="styled-table ordTable">
            <thead>
                <tr>
                    <th>Numero des Analayses</th>
                    <th>Type des analayses</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($medicaments)) {
                    foreach ($medicaments as $medicament) {
                        echo "<tr>";
                        
                        echo "<td>" . htmlspecialchars($medicament['OrdonnanceID']) . "</td>";
                        echo "<td>" . htmlspecialchars($medicament['typeAnalayses']) . "</td>";
                        echo "<td>" . htmlspecialchars($medicament['description']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No medicaments found for this ordonnance.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
    </div>
</body>
</html>
