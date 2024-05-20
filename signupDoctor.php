<?php session_start();include("connect.php");?>
<?php 
	if( isset($_POST['add_medecin']))
	{
		$register = $bdd->exec("INSERT INTO `medcin` (`MedcinID`, `Name`, `Specialty`, `PhoneNumber`, `Email`, `Password`)
		 VALUES('".$_POST['nom']."', ''".$_POST['nom']."', 'assa', '2001', 'abdelheq@gmail.com', 'abd'); or die(mysql_error());
		 
		header('Location: login.php');
	}
	
	if( isset($_POST['add_pharmacie']))
	{
		$register = $bdd->exec("INSERT INTO `pharmacie` (`MAIL`,`PASS`,`NOM`,`GERANT`,`ADDRESS`) VALUES ('".$_POST['mail']."','".$_POST['password']."','".$_POST['nom']."','".$_POST['gerant']."','".$_POST['address']."')")or die(mysql_error());
		header('Location: login.php');
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
	</head>
	<body>
		<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
			<div class="container">
			  <div class="card login-card" style="box-shadow: 0px 0px 10px #555,0px 0px 30px #777;">
				<div class="row no-gutters">
				  <div class="col-md-5">
					<img src="images/login0.jpg" alt="login" class="login-card-img" id="imgmulti">
				  </div>
				  <div class="col-md-7" style="display: flex;justify-content: center;">
					<div class="card-body" style="text-align:center;">
						<p class="login-card-description"> MEDECIN </p>


						<form name='add_medecin' action="" method="post" style="margin: 0 auto;">
						  <div class="form-group">
							number
							<input type="number" name="number" class="form-control" placeholder="mail">
						  </div>
						  <div class="form-group mb-4">
							Mot de Passe
							<input type="password" name="password" class="form-control" placeholder="***********">
						  </div>
						  <div class="form-group">
							Nom
							<input type="text" name="nom" class="form-control" placeholder="nom">
						  </div>
						  <div class="form-group">
							Prenom
							<input type="text" name="pre" class="form-control" placeholder="pre">
						  </div>
						  <div class="form-group">
							Specialité
							<select name="specialite" class="form-control" required>
								<option value=""> - Choix - </option>
								<?php
								$req= $bdd->query("SELECT * FROM `specialite`");
								while($row=$req->fetch())
								{
								echo'<option value="'.$row['ID_SPECIALITE'].'"> '.$row['LIBELLE'].' </option>';
								}
								?>
							</select>
						  </div>
						  <input name="add_medecin" class="btn btn-block login-btn mb-4" type="submit" value="Ajouter">
						</form>
					</div>
					<div class="card-body" style="text-align:center;">
						<p class="login-card-description"> PHARMACIE </p>
						<form name='add_pharmacie' action="" method="post" style="margin: 0 auto;">
						  <div class="form-group">
							E-mail
							<input type="email" name="mail" class="form-control" placeholder="mail">
						  </div>
						  <div class="form-group mb-4">
							Mot de Passe
							<input type="password" name="password" class="form-control" placeholder="***********">
						  </div>
						  <div class="form-group">
							NOM
							<input type="text" name="nom" class="form-control" placeholder="nom">
						  </div>
						  <div class="form-group">
							Gérant
							<input type="text" name="gerant" class="form-control" placeholder="gérant">
						  </div>
						  <div class="form-group">
							Address
							<input type="text" name="address" class="form-control" placeholder="pre">
						  </div>
						  <input name="add_pharmacie" class="btn btn-block login-btn mb-4" type="submit" value="Ajouter">
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
	</body>
</html>
