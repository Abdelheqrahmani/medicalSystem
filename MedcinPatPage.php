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

$ordonnanceQuery = $bdd->query("SELECT * FROM
 `ordonnancemedicament` 
 JOIN `ordonnance` WHERE `ordonnancemedicament`.`OrdonnanceID` = `ordonnance`.`OrdonnanceID`
  AND `ordonnance`.
`PatientID` = '".$idPatient."'");
$ordonnance1 = $ordonnanceQuery->fetchAll();

$ordonnanceQuery = $bdd->query("SELECT * FROM
 `analyses` 
 JOIN `ordonnance` WHERE `analyses`.`OrdonnanceID` = `ordonnance`.`OrdonnanceID`
  AND `ordonnance`.
`PatientID` = '".$idPatient."'");
$ordonnance2 = $ordonnanceQuery->fetchAll();

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
    <a href="#" class="logo"><i class="fas fa-heartbeat"></i>med system</a>
    <nav class="navbar">
        <a href="#home">Account Information</a>
        <a href="deconnexion.php"> log out <i class="fas fa-sign-out-alt"></i></a>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>

<div class="content">
	
   
    <h1 class="doctorName"> <?php echo "numero de patient  ".$idPatient." "; ?></h1>
    <h2>Ajoutez quelque chose : </h2>
    
    <div class="btn add-btn" id="popupButton"  >Ajoutez <i class="fa fa-plus-circle"></i></div>
    <h1>ordonnances</h1>
	<div class="switch">
		<div class="btn" id="ordannaces"> ordannance </div>
		<div class="btn" id="analyses"> Analayses</div>
		<div class="btn" id="analyses"> Rapport medical </div>
	</div>
    <table class="styled-table" id="table-ord" >
        <thead>
            <tr>
                <th>Numero d'ordannance</th>
                <th>Nom de medcin </th>
                <th>Specialite de medcin </th>
                <th>Date</th>
                <th>Type d'ordannance </th>
				<th>  voir les details</th>
			
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($ordonnance1 as $ordonnance1) {
				$idMedcin = $ordonnance1['MedcinID'];
				$medcinQuery = $bdd->query("SELECT * FROM `medcin` WHERE `MedcinID` = '".$idMedcin."'");
				$medcin = $medcinQuery->fetch();

                echo "<tr>";
                echo "<td>" . $ordonnance1['OrdonnanceID'] . "</td>";
               
                echo "<td>" .  $medcin['Name'] . "</td>"; 
				echo "<td>" . $ordonnance1['PatientID'] . "</td>";
                echo "<td>" . $ordonnance1['Date'] . "</td>";
                echo "<td>" . $ordonnance1['Type'] . "</td>";
				echo "<td> <a href='ordPatient.php?id=" . $ordonnance1['OrdonnanceID'] . "' class='btn'>sqdqsd</a>  </td>";

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <table class="styled-table" id="table-anl" style="display: none ; " >
        <thead>
            <tr>
                <th>Numero des analyses</th>
                <th>Nom de medcin </th>
                <th>Specialite de medcin </th>
                <th>Date</th>
                <th>Type d'ordannance </th>
				<th>  voir les details</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            foreach ($ordonnance2 as $ordonnance2) {
				$idMedcinA = $ordonnance2['MedcinID'];
				$medcinQueryA = $bdd->query("SELECT * FROM `medcin` WHERE `MedcinID` = '".$idMedcin."'");
				$medcinA = $medcinQuery->fetch();
                echo "<tr>";
                echo "<td>" . $ordonnance2['OrdonnanceID'] . "</td>";
               
                echo "<td>" .  $medcin['Name'] . "</td>"; 
				echo "<td>" . $ordonnance2['PatientID'] . "</td>";
                echo "<td>" . $ordonnance2['Date'] . "</td>";
                echo "<td>" . $ordonnance2['Type'] . "</td>";
				echo "<td> <a href='anlPatient.php?id=" . $ordonnance2['OrdonnanceID'] . "' class='btn'>sqdqsd</a>  </td>";

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<div id="popupWindow" class="popup">
    <div class="popup-content">
        <h1>que voulez vous ajouter : </h1>
        <span id="closeButton" class="close">&times;</span>
<a class="btn" href='AddOrd.php?patientID=<?php echo $idPatient; ?>'>ordannance</a>
        <a class="btn" href='AddAnl.php?patientID=<?php echo $idPatient; ?>'> Analayses</a>
		<a class="btn" id="analyses"> Rapport medical </a>

    </div>
  
</div>

<script src="js/patient.js"></script>
<script src="js/script.js"></script>
</body>
</html>
