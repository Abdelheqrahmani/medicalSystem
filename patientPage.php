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

$ordonnanceQuery = $bdd->query("SELECT * FROM
 `ordonnancemedicament` 
 JOIN `ordonnance` WHERE `ordonnancemedicament`.`OrdonnanceID` = `ordonnance`.`OrdonnanceID`
  AND `ordonnance`.
`PatientID` = '".$_SESSION['id']."'");
$ordonnance1 = $ordonnanceQuery->fetchAll();

$ordonnanceQuery = $bdd->query("SELECT * FROM
 `analyses` 
 JOIN `ordonnance` WHERE `analyses`.`OrdonnanceID` = `ordonnance`.`OrdonnanceID`
  AND `ordonnance`.
`PatientID` = '".$_SESSION['id']."'");
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
	
    <h1 class="doctorName"> <?php echo "Bienvenue ".$nom." "; ?></h1>
    <h2 class="doctorName"> <?php echo "numero de patient  ".$idPatient." "; ?></h2>
    <h1>ordonnances</h1>
	<div class="switch">
		<div class="btn" id="ordannaces"> ordannance </div>
		<div class="btn" id="analyses"> Analayses</div>
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
<script src="js/patient.js"></script>
</body>
</html>
