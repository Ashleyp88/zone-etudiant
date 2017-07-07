<?php
session_start();
//FONCTIONS.PHP EST LA PAGE CONTENANTS TOUTES LES FONCTIONS DEJA ECRITES JUSQUE LA
include 'pages/fonctions.php';
if(isset($_GET['deconnection']))
{
	session_destroy();
	header("location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Zone Etudiant</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<meta charset="utf-8"/>	
</head>
<body>
<!--*************************************** 	DEBUT TETE DE PAGE 		**********************************-->
	<header>
		<?php include 'pages/header.php'; ?>
	</header>
<!--*************************************** 	FIN TETE DE PAGE 	 	**********************************-->

<!--*************************************** 	DEBUT CORPS DE PAGE 	**********************************-->

	<div id="corps_page">
		<?php
		//ON VERIFIE SI UNE SESSION EST DEJA EN COURS POUR AFFICHER LE CORPS LUI ETANT CORRESPONDANT
			if(isset($_SESSION['pseudo']))
			{
				$type = chercher_info_utilisateur($_SESSION['pseudo'], "type"); 
				if($type == "ETUDIANT")
					include 'pages/etudiant.php';
			}
		//S'IL N'Y A AUCUNE SESSION EN COURS LE CORPS AURA LE FORMULAIRE D'OINSCRIPTION
			else
				include 'pages/formulaire_inscription.php';
		?>
	</div>
<!--*************************************** 	FIN CORPS DE PAGE 		**********************************-->
<!--*************************************** 	DEBUT PIED DE PAGE 		**********************************-->

	<footer>
	</footer>
<!--*************************************** 	FIN PIED DE PAGE		**********************************-->

</body>
</html>