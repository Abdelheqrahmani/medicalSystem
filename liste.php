 <?php
	session_start();
	if(!isset($_SESSION['id']) )
	{ header('Location:index.html');}
	include("connect.php");
	$index=3;
?>
<?php	//Update etat to 0
	if( isset($_GET['id_ordphar_sup']))
	{
		$sup = $bdd->exec("DELETE FROM `ordphar` WHERE `ID_ORDPHAR` = '".$_GET['id_ordphar_sup']."'");
	}
?>
<?php	//Update etat to 1
	if( isset($_GET['id_ordphar_add']))
	{
		$register = $bdd->exec("INSERT INTO `ordphar` (`ID_ORDONNANCE`,`ID_PHARMACIE`) VALUES ('".$_GET['id_ordphar_add']."','".$_SESSION['id']."')")or die(mysql_error());
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
		<link rel="stylesheet" href="css/button.css">
		<link rel="stylesheet" href="css/menu.css">
		<link rel="stylesheet" href="css/logo.css">
		<link rel="stylesheet" href="css/table.css">
	</head>
	
	<body>
		<?php
			include("menu.php");
		?>
		<div style="margin-top:150px;"></div>
		<div class="accordion mt-5" id="accordionExample">
						<div class="tbl-header">
							<table cellpadding="0" cellspacing="0" border="0">
								<thead>
								<tr>
								  <th width="50px">N°</th>
								  <th width="100px">Date</th>
								  <th width="250px">Docteur</th>
								  <th>Médicaments</th>
								  <th width="100px">Disponible</th>
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
									$rech= $bdd->query("SELECT `DATE_ORD`,`ordonnance`.`ID_ORDONNANCE`,`medecin`.`NOM`,`medecin`.`PRENOM`,`LIBELLE` FROM `ordonnance`,`medecin`,`specialite` WHERE `ordonnance`.`ID_MEDECIN`=`medecin`.`ID_MEDECIN` AND `medecin`.`ID_SPECIALITE`=`specialite`.`ID_SPECIALITE` AND `ETAT`='1'");
									while($res=$rech->fetch())
									{
										$n=$n+1;
										echo'<tr>
										<td width="50px">'.$n.'</td>
										<td width="100px">'.$res['DATE_ORD'].'</td>
										<td  width="250px">'.$res['NOM'].' '.$res['PRENOM'].' ('.$res['LIBELLE'].')</td>
										<td>';
										$rech2= $bdd->query("SELECT * FROM `ordmed`,`medicament` WHERE `ordmed`.`ID_MEDICAMENT`=`medicament`.`ID_MEDICAMENT` AND `ID_ORDONNANCE`='".$res['ID_ORDONNANCE']."'");
										while($res2=$rech2->fetch())
										{
											echo '- '.$res2['LIBELLE'].' '.$res2['DOSAGE'].'<br/>';
										}
										echo'
										</td>
										<td>';
										$rech3= $bdd->query("SELECT * FROM `ordphar` WHERE  `ID_PHARMACIE`='".$_SESSION['id']."' AND `ID_ORDONNANCE`='".$res['ID_ORDONNANCE']."'");
										$res3=$rech3->fetch();
										if($res3){echo'<td width="100px">OUI</td><td width="50px"><a href="liste.php?id_ordphar_sup='.$res3['ID_ORDPHAR'].'"><img src="image/inactif.png"/></a></td>';}
										else{echo'<td width="100px">-</td><td width="50px"><a href="liste.php?id_ordphar_add='.$res['ID_ORDONNANCE'].'"><img src="image/actif.png"/></a></td>';}
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
