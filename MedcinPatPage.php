<?php
session_start();
if(!isset($_SESSION['id'])) { 
    header('Location:index.html');
    exit;
}

include("connect.php"); 

$reponse = $bdd->query("SELECT * FROM `patient` WHERE `PatientID` = '".$_SESSION['id']."'"); 
$row = $reponse->fetch(); 
$sms = 0;
if(!$row) {
    $sms = 1;
} else {
    $nom = $row['Name'];
    $idPatient = $row['PatientID'];
}

// Get the id of patient from the URL
if(isset($_GET['id'])) {
    $idPatient = $_GET['id'];
}

// Fetch distinct ordonnances with their medicaments
$ordonnanceQuery = $bdd->query("SELECT DISTINCT `ordonnance`.*, `medcin`.`Name` AS MedcinName, `medcin`.`Specialty` 
FROM `ordonnance`
JOIN `ordonnancemedicament` ON `ordonnance`.`OrdonnanceID` = `ordonnancemedicament`.`OrdonnanceID`
JOIN `medcin` ON `ordonnance`.`MedcinID` = `medcin`.`MedcinID`
WHERE `ordonnance`.`PatientID` = '".$idPatient."'");

$ordonnances = $ordonnanceQuery->fetchAll(PDO::FETCH_ASSOC);

// Fetch distinct ordonnances with their analyses
$analysisQuery = $bdd->query("SELECT DISTINCT `ordonnance`.*, `medcin`.`Name` AS MedcinName, `medcin`.`Specialty` 
FROM `ordonnance`
JOIN `analyses` ON `ordonnance`.`OrdonnanceID` = `analyses`.`OrdonnanceID`
JOIN `medcin` ON `ordonnance`.`MedcinID` = `medcin`.`MedcinID`
WHERE `ordonnance`.`PatientID` = '".$idPatient."'");
$analyses = $analysisQuery->fetchAll(PDO::FETCH_ASSOC);



$rapportQuery = $bdd->prepare("
    SELECT DISTINCT ordonnance.*, medcin.Name AS MedcinName, medcin.Specialty, rapport.RapportID, rapport.title, rapport.description, rapport.file 
    FROM ordonnance
    JOIN rapport ON ordonnance.OrdonnanceID = rapport.OrdonnanceID
    JOIN medcin ON ordonnance.MedcinID = medcin.MedcinID
    WHERE ordonnance.PatientID = :idPatient
");

$rapportQuery->execute(['idPatient' => $idPatient]);
$rapports = $rapportQuery->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html>
<head>
    <title>MA LISTE</title>
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
        <a href="deconnexion.php"> log out <i class="fas fa-sign-out-alt"></i></a>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>

<div class="content">
    <h1 class="doctorName"><?php echo "numero de patient " . $idPatient; ?></h1>
    <h2>Ajoutez quelque chose :</h2>
    
    <div class="btn add-btn" id="popupButton">Ajoutez <i class="fa fa-plus-circle"></i></div>
    <h1>ordonnances</h1>
    <div class="switch">
        <div class="btn" id="ordannaces"> ordannance </div>
        <div class="btn" id="analyses"> Analyses</div>
        <div class="btn" id="rapmed"> Rapport medical </div>
    </div>
    <table class="styled-table" id="table-ord" style = ùù>
        <thead>
            <tr>
                <th>Numero d'ordannance</th>
                <th>Nom de medcin</th>
                <th>Specialite de medcin</th>
                <th>Date</th>
                <th>Type d'ordannance</th>
                <th>voir les details</th>
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
    <table class="styled-table" id="table-anl" style="display: none; width : 100%;">
        <thead>
            <tr>
                <th>Numero des analyses</th>
                <th>Nom de medcin</th>
                <th>Specialite de medcin</th>
                <th>Date</th>
                <th>Type d'ordannance</th>
                <th>voir les details</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($analyses as $analysis): ?>
                <tr>
                    <td><?php echo $analysis['OrdonnanceID']; ?></td>
                    <td><?php echo $analysis['MedcinName']; ?></td>
                    <td><?php echo $analysis['Specialty']; ?></td>
                    <td><?php echo $analysis['Date']; ?></td>
                    <td><?php echo $analysis['Type']; ?></td>
                    <td><a href='anlPatient.php?id=<?php echo $analysis['OrdonnanceID']; ?>' class='btn'>Voir</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <table class="styled-table" id="table-rapp" style="display: none; width : 100%; ">
    <thead>
            <tr>
                <th>Ordonnance ID</th>
                <th>Medcin Name</th>
                <th>Specialty</th>
                <th>Rapport ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>File</th>
                <th>Date</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rapports as $rapport): ?>
            <tr>
                <td><?php echo htmlspecialchars($rapport['OrdonnanceID'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($rapport['MedcinName'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($rapport['Specialty'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($rapport['RapportID'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($rapport['title'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($rapport['description'] ?? ''); ?></td>
                <td>
                    <?php if (!empty($rapport['file'])): ?>
                        <a href="path/to/your/uploads/<?php echo htmlspecialchars($rapport['file']); ?>" download>Download</a>
                    <?php else: ?>
                        No file
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($rapport['Date'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($rapport['Type'] ?? ''); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   
</div>

<div id="popupWindow" class="popup">
    <div class="popup-content">
        <h1>Que voulez-vous ajouter :</h1>
        <span id="closeButton" class="close">&times;</span>
        <a class="btn" href='AddOrd.php?patientID=<?php echo $idPatient; ?>'>Ordannance</a>
        <a class="btn" href='AddAnl.php?patientID=<?php echo $idPatient; ?>'>Analyses</a>
        <a class="btn" id="analyses" href='AddRapp.php?patientID=<?php echo $idPatient; ?>' >Rapport medical</a>
    </div>
</div>

<script src="js/patient.js"></script>
<script src="js/script.js"></script>
</body>
</html>
