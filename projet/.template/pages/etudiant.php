<?php
	include_once 'etudiant/menu.php';

	if(isset($_GET['page']))
	{
		$page=$_GET['page'];
		include 'etudiant/'.$page.'.php';
	}
	else
		include 'etudiant/acceuil.php';
	
?>