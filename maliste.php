 <?php
	session_start();
	if(!isset($_SESSION['id']) )
	{ header('Location:index.html');}
	include("connect.php");
	$index=2;
?>
<?php	//U
	if( isset($_GET['id_ord_0']))
	{
		$modif = $bdd->exec("UPDATE `ordonnance` SET `ETAT`= '0' WHERE `ID_ORDONNANCE` = '".$_GET['id_ord_0']."'");
	}
?>
<?php	//Update etat to 1
	if( isset($_GET['id_ord_1']))
	{
		$modif = $bdd->exec("UPDATE `ordonnance` SET `ETAT`= '1' WHERE `ID_ORDONNANCE` = '".$_GET['id_ord_1']."'");
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
		<div class="accordion mt-5" id="accordionExample" style="margin: 0 auto;width:60%;">
						<div class="tbl-header">
							<table cellpadding="0" cellspacing="0" border="0">
								<thead>
								<tr>
								  <th width="50px">N°</th>
								  <th width="100px">Date</th>
								  <th width="250px">Nom Prenom (age)</th>
								  <th>Médicaments</th>
								  <th>Pharmacie Disponible</th>
								  <th width="100px">Etat</th>
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
									$rech= $bdd->query("SELECT * FROM `ordonnance` WHERE `ID_MEDECIN`='".$_SESSION['id']."' ORDER BY `ETAT` DESC");
									while($res=$rech->fetch())
									{
										$n=$n+1;
										echo'<tr>
										<td width="50px">'.$n.'</td>
										<td width="100px">'.$res['DATE_ORD'].'</td>
										<td  width="250px">'.$res['NOM'].' '.$res['PRENOM'].' ('.$res['AGE'].' ans)</td>
										<td>';
										$rech2= $bdd->query("SELECT * FROM `ordmed`,`medicament` WHERE `ordmed`.`ID_MEDICAMENT`=`medicament`.`ID_MEDICAMENT` AND `ID_ORDONNANCE`='".$res['ID_ORDONNANCE']."'");
										while($res2=$rech2->fetch())
										{
											echo '- '.$res2['LIBELLE'].' '.$res2['DOSAGE'].'<br/>';
										}
										echo'
										</td>
										<td>';
										$rech3= $bdd->query("SELECT * FROM `ordphar`,`pharmacie` WHERE `ordphar`.`ID_PHARMACIE`=`pharmacie`.`ID_PHARMACIE` AND `ID_ORDONNANCE`='".$res['ID_ORDONNANCE']."'");
										while($res3=$rech3->fetch())
										{
											echo '- '.$res3['NOM'].' ( E-mail: '.$res3['MAIL'].' ) ( Address: '.$res3['ADDRESS'].' )<br/>';
										}
										echo'
										</td>';
										if($res['ETAT']=="1"){echo'<td width="100px">ACTIF</td><td width="50px"><a href="maliste.php?id_ord_0='.$res['ID_ORDONNANCE'].'"><img src="image/inactif.png"/></a></td>';}
										else{echo'<td width="100px">INACTIF</td><td width="50px"><a href="maliste.php?id_ord_1='.$res['ID_ORDONNANCE'].'"><img src="image/actif.png"/></a></td>';}
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
