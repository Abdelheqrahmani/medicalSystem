<?php 
session_start();
if(!isset($_SESSION['id'])) { 
    header('Location:index.html');
    exit;
}

include("connect.php"); // Include the file that contains the database connection

$reponse = $bdd->query("SELECT * FROM `patient` WHERE `PatientID` = '".$_SESSION['id']."'"); // Execute the SQL query
$row = $reponse->fetch(); // Fetch the result from the query
$sms = 0;
if(!$row) {
    $sms = 1;
} else {
    $nom = $row['Name'];
	$idPatient = $row['PatientID'];
}

$ordonnanceQuery = $bdd->query("SELECT * FROM `ordonnance` WHERE `PatientID` = '".$_SESSION['id']."'");
$ordonnances = $ordonnanceQuery->fetchAll();



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
            foreach ($ordonnances as $ordonnance) {
				$idMedcin = $ordonnance['MedcinID'];
				$medcinQuery = $bdd->query("SELECT * FROM `medcin` WHERE `MedcinID` = '".$idMedcin."'");
				$medcin = $medcinQuery->fetch();

                echo "<tr>";
                echo "<td>" . $ordonnance['OrdonnanceID'] . "</td>";
               
                echo "<td>" .  $medcin['Name'] . "</td>"; 
				echo "<td>" . $ordonnance['PatientID'] . "</td>";
                echo "<td>" . $ordonnance['Date'] . "</td>";
                echo "<td>" . $ordonnance['Type'] . "</td>";
				echo "<td> <a href='ordPatient.php?id=" . $ordonnance['OrdonnanceID'] . "' class='btn'>sqdqsd</a>  </td>";

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
        </tbody>
    </table>
</div>
<script src="js/patient.js"></script>
</body>
</html>
