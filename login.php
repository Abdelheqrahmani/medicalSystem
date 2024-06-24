<?php
session_start();
include("connect.php");

$sms = 0; 

if (isset($_POST['Entrer'])) {
    // Nettoyage des entrées
    $email = str_replace("'", "\'", $_POST['mail']);
    $password = str_replace("'", "\'", $_POST['password']);
    $category = $_POST['categorie'];

    if ($category == "medecin") {
        // Requête pour les médecins
        $query = $bdd->prepare("SELECT * FROM medcin WHERE Email = :email AND Password = :password");
        $query->execute(['email' => $email, 'password' => $password]);
        $row = $query->fetch();

        if (!$row) {
            $sms = 1;
        } else {
            $_SESSION['categorie'] = $category;
            $_SESSION['id'] = $row['MedcinID'];
            header('Location: medcinPage.php');
            exit();
        }
    } elseif ($category == "patient") {
        // Requête pour les patients
        $query = $bdd->prepare("SELECT * FROM patient WHERE Email = :email AND Password = :password");
        $query->execute(['email' => $email, 'password' => $password]);
        $row = $query->fetch();

        if (!$row) {
            $sms = 1;
        } else {
            $_SESSION['categorie'] = $category;
            $_SESSION['id'] = $row['PatientID'];
            header('Location: patientPage.php');
            exit();
        }
    } elseif ($category == "pharmacie") {
        // Requête pour les pharmacies
        $query = $bdd->prepare("SELECT * FROM pharmacie WHERE Email = :email AND Password = :password");
        $query->execute(['email' => $email, 'password' => $password]);
        $row = $query->fetch();

        if (!$row) {
            $sms = 1;
        } else {
            $_SESSION['categorie'] = $category;
            $_SESSION['id'] = $row['PharmacieID'];
            header('Location: pharmaciePage.php');
            exit();
        }
    } elseif ($category == "laboratoire") {
        // Requête pour les laboratoires
        $query = $bdd->prepare("SELECT * FROM laboratoire WHERE Email = :email AND Password = :password");
        $query->execute(['email' => $email, 'password' => $password]);
        $row = $query->fetch();

        if (!$row) {
            $sms = 1;
        } else {
            $_SESSION['categorie'] = $category;
            $_SESSION['id'] = $row['LaboratoireID'];
            header('Location: laboratoirePage.php');
            exit();
        }
    }
}
?>
<!doctype html>
<html>
	<head>
		<title>Budget Fonctionelle</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/login.css">
		<link rel="stylesheet" href="css/logo.css">
	</head>
	<body>
		<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
			<div class="container">
			  <div class="card login-card" style="box-shadow: 0px 0px 10px #555,0px 0px 30px #777;">
				<div class="row no-gutters">
				  <div class="col-md-5">
					<img src="images/login0.jpg" alt="login" class="login-card-img" id="imgmulti">
				  </div>
				  <div class="col-md-7">
					<div class="card-body" style="text-align:center;">
					  <div class="site-logo">
				
						<div class="site-title">
							<div id="logo-text" class="site-title-text">
							 Sihati <span>Tadj</span>
							</div>
						</div>
					  </div><br/>
					  <p class="login-card-description"> Bienvenue | Welcome | مرحبا</p>
						<form name='login' action="" method="post" style="margin: 0 auto;">
						  <div class="form-group">
							<select name="categorie" class="form-control" required>
								<option value="">- Catégorie -</option>
								<option value="medecin">Médecin</option>
								<option value="pharmacie">Pharmacie</option>
								<option value="patient">Patient</option>
								<option value="laboratoire">Laboratoire</option>
							</select>
						  </div>
						  <div class="form-group">
							<input type="email" name="mail" class="form-control" placeholder="e-mail">
						  </div>
						  <div class="form-group mb-4">
							<input type="password" name="password" class="form-control" placeholder="***********">
						  </div>
						  <input name="Entrer" class="btn btn-block login-btn mb-4" type="submit" value="Entrer">
						  <?php if($sms==1){echo'<div style="color:red;text-align:center"> E-mail ou mot de passe  incorrecte !!</div>';} ?> 
						</form>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		</main>
		<script>
		(function()
		{
			var imgmulti = document.getElementById('imgmulti'),i = 1;
			var intervalID = setInterval(function() {imgmulti.src = 'image/login'+i+'.jpg';i =(i+1) % 3;}, 3000);
		})();
		</script>
		<script src="js/anime.js"></script>
		<script src="js/logo.js"></script>
	</body>
</html>
