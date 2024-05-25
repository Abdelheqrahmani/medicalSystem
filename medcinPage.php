

	<?php session_start();

	
	if(!isset($_SESSION['id']) )
	{ header('Location:index.html');}
	


	include("connect.php"); // Include the file that contains the database connection code

	$reponse = $bdd->query("SELECT * FROM `medcin` where `MedcinID` = '".$_SESSION['id']."'"); // Execute the SQL query
	$row = $reponse->fetch(); // Fetch the result from the query
	$sms=0;
	if(!$row)
			{ $sms=1;}
			else {
				$nom=$row['Name'];
			
		}


		/// search for patient 

		if (isset($_POST['submit'])) {
			// Initialize the database connection ($bdd) properly here.
			
			$reponse = $bdd->query("SELECT * FROM `patient` WHERE `PatientID` = '" . $_POST['idPatient'] . "'"); // Execute the SQL query
			$row = $reponse->fetch(); // Fetch the result from the query
			
			if ($row) {
				// Redirect to test.html if the row exists
				header("Location: test.html");
				exit(); // Make sure to call exit after header redirection
			} else {
				echo "Patient not found.";
			}
		}
		
		
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

<a href="#" class="logo"> <i class="fas fa-heartbeat"></i> medcare </a>

<nav class="navbar">
	<a href="#home">Account Information</a>
	<a href="deconnexion.php"> log out 
		<i class="fas fa-sign-out-alt"></i>
	</a>
</nav>

<div id="menu-btn" class="fas fa-bars"></div>

</header>


<div class="content">
	<h1 class="doctorName"> <?php 
		echo "Bienvenue Dr. ".$nom." ";
	?></h1>
	<div class="searchPatient">
		
<h1> Entrez le identificateur de votre patient </h1>

	<form name='login' class="formIdPatient" action="" method="post" style="margin: 0 auto;">
						
<label for="idPatient">!</label>
	<input type="number" name="idPatient" id="idPatient"  class="id" placeholder="Entrez l id de patient ">
	<input type="submit" class="search" name="submit">
	<?php if($sms==1){echo'<div style="color:red;text-align:center"> E-mail ou mot de passe  incorrecte !!</div>';} ?> 

	</form>
	

</div>

	</div>
	</body>
</html>
