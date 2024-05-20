<?php 
	try {$bdd =new PDO('mysql:host=localhost;dbname=medicalsystem','root','');}
	catch(Exception $e)
	{ die('Erreur : '.$e->getMessage());}// En cas d'erreur 
?>