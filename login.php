<?php session_start();include("connect.php");?>
<?php 
	if( isset($_POST['Entrer']))
	{
		$_POST['mail']=str_replace("'","\'",$_POST['mail']);
		$_POST['password']=str_replace("'","\'",$_POST['password']);
		if($_POST['categorie']=="medecin")
		{
			$reponse = $bdd->query("SELECT * FROM `medecin` where `MAIL` = '".$_POST['mail']	."' AND `PASS` = '".$_POST['password']."'");
			$row = $reponse->fetch();
			if(!$row)
			{ $sms=1;}
			else
			{$_SESSION['categorie']=$_POST['categorie'];$_SESSION['id']=$row['ID_MEDECIN'];header('Location: ordonnance.php');}
		}
		else{
			$reponse = $bdd->query("SELECT * FROM `pharmacie` where `MAIL` = '".$_POST['mail']	."' AND `PASS` = '".$_POST['password']."'");
			$row = $reponse->fetch();
			
			if(!$row)
			{ $sms=1;}
			else
			{$_SESSION['categorie']=$_POST['categorie'];$_SESSION['id']=$row['ID_PHARMACIE'];header('Location: liste.php');}
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
						<figure id="logo">
							<svg width="100%" height="100%" viewBox="0 0 148 128">
							  <defs>
								<mask id="circle-mask">
								  <rect fill="white" width="100%" height="100%"></rect>
								  <circle id="logo-mask" fill="black" cx="120" cy="96" r="28"></circle>
								</mask>
							  </defs>
							  <polygon id="logo-hexagon" fill="#00B4FF" points="64 128 8.574 96 8.574 32 64 0 119.426 32 119.426 96" mask="url(#circle-mask)"></polygon>
							  <circle id="logo-circle" fill="#3F3C3C" cx="120" cy="96" r="20"></circle>
							</svg> 
						</figure>
						<div class="site-title">
							<div id="logo-text" class="site-title-text">
							  Med<span>care</span>
							</div>
						</div>
					  </div><br/>
					  <p class="login-card-description"> Bienvenue | Welcome | مرحبا</p>
						<form name='login' action="" method="post" style="margin: 0 auto;">
						  <div class="form-group">
							<select name="categorie" class="form-control" required>
								<option value="">- Categorie -</option>
								<option value="medecin">Medecin</option>
								<option value="pharmacie">Pharmacie</option>
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
					<p style="text-align:right;padding-right:10px">Copyright ® DEV By: ZANE<p/>
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
