<?php
	session_start();
	if(!isset($_SESSION['id']) )
	{ header('Location:index.html');}
	include("connect.php");
	$index=4;
?>
<?php
	if( isset($_POST['sub_modif']))
	{
		if($_SESSION['categorie']=="medecin")
		{
			$modif = $bdd->exec("UPDATE `medecin` SET `NOM`='".$_POST['nom']."' , `PRENOM`='".$_POST['pre']."' , `ID_SPECIALITE`='".$_POST['specialite']."' , `MAIL`='".$_POST['mail']."' WHERE `ID_MEDECIN` = '".$_SESSION['id']."'");$info_ok=1;

			if($_POST['passnew']==$_POST['passnew2'] && $_POST['passnew']!="" && $_POST['passnew2']!="")
			{
				$modif2 = $bdd->exec("UPDATE `medecin` SET `PASS`='".$_POST['passnew']."' WHERE `ID_MEDECIN` = '".$_SESSION['id']."'");$sms=1;
			}
			else{$sms=2;}
		}
		else
		{
			$modif = $bdd->exec("UPDATE `pharmacie` SET `NOM`='".$_POST['nom']."' ,`GERANT`='".$_POST['gerant']."' , `ADDRESS`='".$_POST['address']."' , `MAIL`='".$_POST['mail']."' WHERE `ID_PHARMACIE` = '".$_SESSION['id']."'");$info_ok=1;

			if($_POST['passnew']==$_POST['passnew2'] && $_POST['passnew']!="" && $_POST['passnew2']!="")
			{
				$modif2 = $bdd->exec("UPDATE `BENEVOLE` SET `PASS`='".$_POST['passnew']."' WHERE `ID_PHARMACIE` = '".$_SESSION['id']."'");$sms=1;
			}
			else{$sms=2;}
		}
		
	}
?>
<?php
	if($_SESSION['categorie']=="medecin")
	{
		$req = $bdd->query("SELECT * FROM `medecin` where `ID_MEDECIN` = '".$_SESSION['id']."'");
		$info = $req->fetch();
	}
	else
	{
		$req = $bdd->query("SELECT * FROM `pharmacie` where `ID_PHARMACIE` = '".$_SESSION['id']."'");
		$info = $req->fetch();
	}
?>
<!doctype html>
<html>
	<head>
		<title>GESTION</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/Bootstrap.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/index.css">
		<link rel="stylesheet" href="css/button.css">
		<link rel="stylesheet" href="css/menu.css">
		<link rel="stylesheet" href="css/logo.css">
	</head>
	
	<body>
		<?php
			include("menu.php");
		?>
		<div style="margin-top:150px;"></div>
		<div class="accordion mt-5" id="accordionExample" style="margin: 0 auto;width:60%;">
				<h1>Mes Information</h1>
				<?php 
				if($info_ok==1){echo'<div style="width:100%;background:green;color:white;font-weight:bold;text-align:center;padding:10px;">Information actualisé avec succès</div>';}
				if($sms==1){echo'<div style="width:100%;background:green;color:white;font-weight:bold;text-align:center;padding:10px;">votre mot de passe à été modifier avec succès</div>';}
				if($sms==2){echo'<div style="width:100%;background:red;color:white;font-weight:bold;text-align:center;padding:10px;">mot de passe non modifier</div>';}
				?>
				<form name="modif_info" method="post" action="">
				<table  valign="meduim" style="margin: 0 auto;width:100%;">
				<?php
				if($_SESSION['categorie']=="medecin")
				{
					echo'
					<tr>
						<td>Nom</td>
						<td><input type="text" name="nom" value="'.$info['NOM'].'" required></td>
					</tr>
					<tr>
						<td>Prenom</td>
						<td><input type="text" name="pre" value="'.$info['PRENOM'].'" required></td>
					</tr>
					<tr>
						<td>Specialité</td>
						<td>
							<select name="specialite" required>';
							$req= $bdd->query("SELECT * FROM `specialite`");
							while($row=$req->fetch())
							{
								if($row['ID_SPECIALITE']==$info['ID_SPECIALITE']){echo'<option value="'.$row['ID_SPECIALITE'].'"selected="selected"> '.$row['LIBELLE'].' </option>';}
								else{echo'<option value="'.$row['ID_SPECIALITE'].'"> '.$row['LIBELLE'].' </option>';}
							}
							echo'
							</select>
						</td>
					</tr>';
				}
				else
				{
					echo'
					<tr>
						<td>Nom de Pharmacie</td>
						<td><input type="text" name="nom" value="'.$info['NOM'].'" required></td>
					</tr>
					<tr>
						<td>Gérant</td>
						<td><input type="text" name="gerant" value="'.$info['GERANT'].'" required></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><input type="text" name="address" value="'.$info['ADDRESS'].'" required></td>
					</tr>';
				}
				?>
					<tr>
						<td style="min-width:150px">E-Mail</td>
						<td><input type="email" name="mail" value="<?php echo $info['MAIL'];?>" required></td>
					</tr>
					<tr>
						<td>Nouveau Mot de Passe</td>
						<td><input type="password" name="passnew"></td>
					</tr>
					<tr>
						<td>Confirmer Mot de Passe</td>
						<td><input type="password" name="passnew2"></td>
					</tr>
					<tr>
						<td align="center" colspan="2"><input type="submit" name="sub_modif" value="Modifier" style="width:100%"></td>
					</tr>
				</table>
				</form>
		</div>
		<?php
		include("footer.html");
		?>
		<script src="js/jquery-3.5.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/anime.js"></script> <!--LOGO-->
		<script src="js/menu.js"></script>
		<script src="js/logo.js"></script>
	</body>
</html>