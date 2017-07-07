<form method="POST" action="index.php" id="form_connexion" class="form-inline col-sm-6 col-sm-offset-4" >
	<input type="text" placeholder="Pseudo" name="pseudo"></input>
	<input type="password" placeholder="Mot de passe" name="mot_de_passe"></input>
	<input type="submit" value="Connecter"></input>
	<?php	if(isset($_GET['erreur']))	echo '<p style="color:white;">Pseudo ou mot de passe incorrect.</p>';?>
</form>

<?php


if(isset($_POST['pseudo']) and isset($_POST['mot_de_passe']))
{
	$pseudo = $_POST['pseudo'];
	$mot_de_passe = $_POST['mot_de_passe'];
	$verifier = authentifier_utilisateur($pseudo, $mot_de_passe);
	if($verifier==1){
		$_SESSION['pseudo']=$pseudo;
	header("location: index.php?home");
	}
	else
		header("location: index.php?erreur");
}
	
?>
