<div id="navbar">
	
	<div class="site-logo" style="float:left;">
		<div class="site-title">
			<div id="logo-text">
				Med<span>Care</span>
			</div>
		</div>
	</div>
	<div id="navbar-right">
		<?php
		if($_SESSION['categorie']=="medecin")
		{
			if($index==1){echo'<a class="active" href="ordonnance.php">Ordonnance</a>';}
			else{ echo'<a href="ordonnance.php">Ordonnance</a>';}
			if($index==2){echo'<a class="active" href="maliste.php">Ma Liste</a>';}
			else{ echo'<a href="maliste.php">Ma Liste</a>';}
			
		}
		else
		{
			if($index==3){echo'<a class="active" href="liste.php">Ma Liste</a>';}
			else{ echo'<a href="liste.php">Liste</a>';}
		}
		?>
		<a <?php if($index==4){echo 'class="active"';}?> href="gestion.php">Gestion</a>
		<a href="deconnexion.php" style="color:red;">Quitter</a>
	</div>
</div>