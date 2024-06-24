<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:index.html');
    exit;
}

include("connect.php");

$reponse = $bdd->query("SELECT * FROM `patient` WHERE `PatientID` = '" . $_SESSION['id'] . "'");
$row = $reponse->fetch();
$sms = 0;
if (!$row) {
    $sms = 1;
} else {
    $nom = $row['Name'];
    $idPatient = $row['PatientID'];
}

// Get the id of patient from the URL
if (isset($_GET['id'])) {
    $idPatient = $_GET['id'];
}

// Fetch distinct ordonnances with their medicaments
$ordonnanceQuery = $bdd->query("SELECT DISTINCT `ordonnance`.*, `medcin`.`Name` AS MedcinName, `medcin`.`Specialty` 
FROM `ordonnance`
JOIN `ordonnancemedicament` ON `ordonnance`.`OrdonnanceID` = `ordonnancemedicament`.`OrdonnanceID`
JOIN `medcin` ON `ordonnance`.`MedcinID` = `medcin`.`MedcinID`
WHERE `ordonnance`.`PatientID` = '" . $idPatient . "'");

$ordonnances = $ordonnanceQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html>
<head>
    <title>Liste des ordonnances</title>
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
    <a href="#" class="logo"><i class="fas fa-heartbeat"></i>Sihati Tadj</a>
    <nav class="navbar">
        <a href="#home">Account Information</a>
        <a href="pharmaciepage.php">Retour à la pharmacie</a>
        <a href="deconnexion.php">Déconnexion <i class="fas fa-sign-out-alt"></i></a>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>

<div class="content">
    <h1 class="doctorName"><?php echo "Numéro du patient " . $idPatient; ?></h1>
    <h1>Ordonnances</h1>
    <table class="styled-table" id="table-ord">
        <thead>
        <tr>
            <th>Numéro d'ordonnance</th>
            <th>Nom du médecin</th>
            <th>Spécialité du médecin</th>
            <th>Date</th>
            <th>Type d'ordonnance</th>
            <th>Voir les détails</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($ordonnances as $ordonnance): ?>
            <tr>
                <td><?php echo $ordonnance['OrdonnanceID']; ?></td>
                <td><?php echo $ordonnance['MedcinName']; ?></td>
                <td><?php echo $ordonnance['Specialty']; ?></td>
                <td><?php echo $ordonnance['Date']; ?></td>
                <td><?php echo $ordonnance['Type']; ?></td>
                <td><a href='ordPatient.php?id=<?php echo $ordonnance['OrdonnanceID']; ?>' class='btn'>Voir</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="js/patient.js"></script>
<script src="js/script.js"></script>
</body>
</html>
