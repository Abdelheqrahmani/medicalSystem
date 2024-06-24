<?php 
session_start();

if (!isset($_SESSION['id'])) {
    header('Location:index.html');
}

include("connect.php");

$reponse = $bdd->query("SELECT * FROM `pharmacie` WHERE `PharmacieID` = '".$_SESSION['id']."'");
$row = $reponse->fetch();
$sms = 0;

if (!$row) {
    $sms = 1;
} else {
    $nom = $row['Name'];
}

// Recherche du patient
if (isset($_POST['submit'])) {
    $patientID = $_POST['idPatient'];
    $query = $bdd->prepare("SELECT * FROM `patient` WHERE `PatientID` = :patientID");
    $query->execute(['patientID' => $patientID]);
    $result = $query->fetch();

    if ($result) {
        // Redirection vers la page du patient
        header("Location: PharmaciePatientPage.php?id=" . $patientID);
        exit();
    } else {
        echo "Patient introuvable.";
    }
}
?>

<!doctype html>
<html>
<head>
    <title>Page Pharmacie</title>
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
    <a href="#" class="logo"> <i class="fas fa-prescription-bottle-alt"></i> Pharmacie</a>
    <nav class="navbar">
        <a href="PharmacieProfile.php">Informations du compte</a>
        <a href="deconnexion.php">Déconnexion <i class="fas fa-sign-out-alt"></i></a>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>

<div class="content">
    <h1 class="pharmacieName">
        <?php echo "Bienvenue à la pharmacie ".$nom." "; ?>
    </h1>
    <div class="searchPatient">
        <h1>Recherchez un patient par son identifiant :</h1>
        <form name='search_patient' class="formSearchPatient" action="" method="post" style="margin: 0 auto;">
            <label for="idPatient">ID du patient :</label>
            <input type="number" name="idPatient" id="idPatient" class="id" placeholder="Entrez l'ID du patient">
            <input type="submit" class="search" name="submit" value="Rechercher">
            <?php if ($sms == 1) { echo'<div style="color:red;text-align:center">Erreur: Pharmacie non trouvée.</div>'; } ?>
        </form>
    </div>
</div>
</body>
</html>
