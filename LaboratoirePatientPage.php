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

// Fetch distinct analyses for the patient
$analysisQuery = $bdd->query("SELECT DISTINCT `analyses`.*, `medcin`.`Name` AS MedcinName, `medcin`.`Specialty`, `ordonnance`.`Date`, `ordonnance`.`Type` 
                               FROM `analyses`
                               JOIN `ordonnance` ON `analyses`.`OrdonnanceID` = `ordonnance`.`OrdonnanceID`
                               JOIN `medcin` ON `ordonnance`.`MedcinID` = `medcin`.`MedcinID`
                               WHERE `ordonnance`.`PatientID` = '" . $idPatient . "'");

// Check if the query executed successfully
if (!$analysisQuery) {
    die('Error executing the query: ' . $bdd->errorInfo()[2]);
}

// Fetch the results
$analyses = $analysisQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html>
<head>
    <title>Liste des Analyses</title>
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
        <a href="deconnexion.php">Log out <i class="fas fa-sign-out-alt"></i></a>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>

<div class="content">
    <h1 class="doctorName"><?php echo "Numéro du patient " . $idPatient; ?></h1>
    <h1>Analyses</h1>
    <table class="styled-table" id="table-anl">
        <thead>
            <tr>
                <th>Numéro des analyses</th>
                <th>Nom du médecin</th>
                <th>Spécialité du médecin</th>
                <th>Date</th>
                <th>Type d'ordonnance</th>
                <th>Voir les détails</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($analyses as $analysis): ?>
                <tr>
                    <td><?php echo $analysis['OrdonnanceID']; ?></td>
                    <td><?php echo $analysis['MedcinName']; ?></td>
                    <td><?php echo $analysis['Specialty']; ?></td>
                    <td><?php echo isset($analysis['Date']) ? $analysis['Date'] : ''; ?></td>
                    <td><?php echo isset($analysis['Type']) ? $analysis['Type'] : ''; ?></td>
                    <td><a href='anlPatient.php?id=<?php echo $analysis['OrdonnanceID']; ?>' class='btn'>Voir</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal for uploading results -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Ajouter les résultats</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ordonnanceID" id="ordonnanceID">
                    <div class="form-group">
                        <label for="title">Titre:</label>
                        <input type="text" class="form-control" name="title" id="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" name="description" id="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="resultFile">Fichier des résultats:</label>
                        <input type="file" class="form-control" name="resultFile" id="resultFile" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Téléverser</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    $('#uploadModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var ordonnanceID = button.data('id');
        var modal = $(this);
        modal.find('.modal-body #ordonnanceID').val(ordonnanceID);
    });
</script>

</body>
</html>
