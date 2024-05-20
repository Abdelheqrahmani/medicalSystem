<?php
	session_start();
	include("connect.php");
?>
<?php	//ajouter medicament
	if( isset($_POST['sub_add_m']))
	{
		$register = $bdd->exec("INSERT INTO `medicament` (`LIBELLE`,`DOSAGE`) VALUES ('".$_POST['libelle']."','".$_POST['dosage']."')")or die(mysql_error());
	}
?>
<?php	//supprission medicament
	if( isset($_GET['id_med']))
	{
		$sup = $bdd->exec("DELETE FROM `medicament` WHERE `ID_MEDICAMENT` = '".$_GET['id_med']."'");
	}
?>
<?php	//ajouter specialité
	if( isset($_POST['sub_add_s']))
	{
		$register = $bdd->exec("INSERT INTO `specialite` (`LIBELLE`) VALUES ('".$_POST['libelle']."')")or die(mysql_error());
	}
?>
<?php	//supprission specialité
	if( isset($_GET['id_spe']))
	{
		$sup = $bdd->exec("DELETE FROM `specialite` WHERE `ID_SPECIALITE` = '".$_GET['id_spe']."'");
	}
?>
<!doctype html>
<html>
	<head>
		<title>ADMIN</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/Bootstrap.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/index.css">
		<link rel="stylesheet" href="css/button.css">
		<link rel="stylesheet" href="css/menu.css">
		<link rel="stylesheet" href="css/logo.css">
		<link rel="stylesheet" href="css/table.css">
	</head>
	
	<body>
		<?php
		include("footer.html");
		?>
		<div style="margin-top:150px;"></div>
		<div class="accordion mt-5" id="accordionExample" style="margin: 0 auto;width:50%;">
			<h1>Ajouter Medicament</h1>
				<form name="add_medicament" method="post" action="">
				<table  valign="meduim" style="margin: 0 auto;width:100%;">
					<tr>
						<td colspan="2" style="font-weight:bold;padding-top:20px;">Information de Patient</td>
					</tr>
					<tr>
						<td>Description</td>
						<td><input type="text" name="libelle" value="" required></td>
					</tr>
					<tr>
						<td>Dosage</td>
						<td><input type="text" name="dosage" value="" required></td>
					</tr>
					<tr>
						<td align="center" colspan="2"><input type="submit" name="sub_add_m" value="Ajouter" style="width:100%"></td>
					</tr>
				</table>
				</form>
				
						<div class="tbl-header">
							<table cellpadding="0" cellspacing="0" border="0">
								<thead>
								<tr>
								  <th width="50px">N°</th>
								  <th>Description</th>
								  <th>Dosage</th>
								  <th width="50px"></th>
								</tr>
								</thead>
							</table>
						</div>
						<div class="tbl-content">
							<table cellpadding="0" cellspacing="0" border="0">
								<tbody>
								<?php
								$n=0;
									$rech= $bdd->query("SELECT * FROM `medicament`");
									while($res=$rech->fetch())
									{
										$n=$n+1;
										echo'<tr>
										<td width="50px">'.$n.'</td>
										<td>'.$res['LIBELLE'].'</td>
										<td>'.$res['DOSAGE'].'</td>';
										$rech2= $bdd->query("SELECT * FROM `ordmed` WHERE  `ID_MEDICAMENT`='".$res['ID_MEDICAMENT']."'");
										$res2=$rech2->fetch();
										if($res2){echo'<td width="50px"></td>';}
										else{echo'<td width="50px"><a href="admin.php?id_med='.$res['ID_MEDICAMENT'].'"><img src="image/inactif.png"/></a></td>';}
										echo'
										</tr>';
									}
								?>
								</tbody>
							</table>
						</div>
			<br><br>
			<h1>Ajouter Specialité</h1>
				<form name="add_specialite" method="post" action="">
				<table  valign="meduim" style="margin: 0 auto;width:100%;">
					<tr>
						<td colspan="2" style="font-weight:bold;padding-top:20px;">Information de Patient</td>
					</tr>
					<tr>
						<td>Description</td>
						<td><input type="text" name="libelle" value="" required></td>
					</tr>
					<tr>
						<td align="center" colspan="2"><input type="submit" name="sub_add_s" value="Ajouter" style="width:100%"></td>
					</tr>
				</table>
				</form>
				
						<div class="tbl-header">
							<table cellpadding="0" cellspacing="0" border="0">
								<thead>
								<tr>
								  <th width="50px">N°</th>
								  <th>Description</th>
								  <th width="50px"></th>
								</tr>
								</thead>
							</table>
						</div>
						<div class="tbl-content">
							<table cellpadding="0" cellspacing="0" border="0">
								<tbody>
								<?php
								$n=0;
									$rech= $bdd->query("SELECT * FROM `specialite`");
									while($res=$rech->fetch())
									{
										$n=$n+1;
										echo'<tr>
										<td width="50px">'.$n.'</td>
										<td>'.$res['LIBELLE'].'</td>';
										$rech2= $bdd->query("SELECT * FROM `medecin` WHERE  `ID_SPECIALITE`='".$res['ID_SPECIALITE']."'");
										$res2=$rech2->fetch();
										if($res2){echo'<td width="50px"></td>';}
										else{echo'<td width="50px"><a href="admin.php?id_spe='.$res['ID_SPECIALITE'].'"><img src="image/inactif.png"/></a></td>';}
										echo'
										</tr>';
									}
								?>
								</tbody>
							</table>
						</div>
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