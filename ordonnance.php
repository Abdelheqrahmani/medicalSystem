<?php
	session_start();
	if(!isset($_SESSION['id']) )
	{ header('Location:index.html');}
	include("connect.php");
	$index=1;
?>
<?php
	if( isset($_POST['sub_add']))
	{
		$register = $bdd->exec("INSERT INTO `ordonnance` (`NOM`,`PRENOM`,`AGE`,`DATE_ORD`,`ETAT`,`ID_MEDECIN`) VALUES ('".$_POST['nom']."','".$_POST['pre']."','".$_POST['age']."','".date("Y-m-d H:i:s")."','1','".$_SESSION['id']."')")or die(mysql_error());
		
		$reponse = $bdd->query("SELECT `ID_ORDONNANCE` FROM `ordonnance` ORDER BY `ID_ORDONNANCE` DESC LIMIT 1");
		$row = $reponse->fetch();
		for ($i = 1; $i <= 6; $i++)
		{
			if($_POST['med'.$i.'']!="")
			{
				$register = $bdd->exec("INSERT INTO `ordmed` (`ID_ORDONNANCE`,`ID_MEDICAMENT`) VALUES ('".$row['ID_ORDONNANCE']."','".$_POST['med'.$i.'']."')")or die(mysql_error());
			}
		}
		header('Location: maliste.php');
		
	}
?>
<!doctype html>
<html>
	<head>
		<title>ORDONNANCE</title>
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
		<div class="accordion mt-5" id="accordionExample" style="margin: 0 auto;width:50%;">
			<h1>Ajouter Ordonnance</h1>
				<form name="add_ord" method="post" action="">
				<table  valign="meduim" style="margin: 0 auto;width:100%;">
					<tr>
						<td colspan="2" style="font-weight:bold;padding-top:20px;">Information de Patient</td>
					</tr>
					<tr>
						<td>Nom</td>
						<td><input type="text" name="nom" value="" required></td>
					</tr>
					<tr>
						<td>Prenom</td>
						<td><input type="text" name="pre" value="" required></td>
					</tr>
					<tr>
						<td>Age</td>
						<td><input type="number" name="age" value="" required></td>
					</tr>
					<tr>
						<td colspan="2" style="font-weight:bold;padding-top:20px;">Médicament</td>
					</tr>
					<?php
					for ($i = 1; $i <= 6; $i++)
					{
						echo'
						<tr>
							<td>Medicament 0'.$i.'</td>
							<td>
								<select name="med'.$i.'" >
								<option value=""></option>';
								$req= $bdd->query("SELECT * FROM `medicament`");
								while($row=$req->fetch())
								{
									echo'<option value="'.$row['ID_MEDICAMENT'].'"> '.$row['LIBELLE'].' '.$row['DOSAGE'].' </option>';
								}
								echo'
								</select>
							</td>
						</tr>
						';
					}
					?>
					<tr>
						<td align="center" colspan="2"><input type="submit" name="sub_add" value="Ajouter" style="width:100%"></td>
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