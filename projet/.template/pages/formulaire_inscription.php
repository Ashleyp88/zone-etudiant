<section id="corps_inscription" class="row" >
		<form class="col-md-4 col-md-offset-6" method="POST" id="form_inscription" action="index.php?adduser">
			<label for="nom">Nom</label><input required type="text" placeholder= "Nom:Jean"	class="form-control" name="nom" id="nom" 
			<?php if(isset($_GET['result']))
					if($_GET['nom']!=1)
						echo 'value="'.$_GET['nom'].'"';
			?> 
			 ></input>
			<?php if(isset($_GET['result']))
					if($_GET['nom']==1)
						echo '<p>Nom invalide </p>';
			?>
			<label for="prenom">Prenom</label><input required type="text" placeholder= "Prenom:Jacques" class="form-control" name="prenom" id="prenom"
			<?php if(isset($_GET['result']))
					if($_GET['prenom']!=1)
						echo 'value="'.$_GET['prenom'].'"';
			?>
			></input>
			<?php if(isset($_GET['result']))
					if($_GET['prenom']==1)
						echo '<p>Prenom invalide</p>';
			?>
			<label for="pseudo">Pseudo</label><input  required type="text" placeholder= "Pseudo:joe15" class="form-control"  name="pseudo" id="pseudo"
			<?php if(isset($_GET['result']))
					if($_GET['pseudo']!=1)
						echo 'value="'.$_GET['pseudo'].'"';
			?>
			></input>
			<?php if(isset($_GET['result']))
					if($_GET['pseudo']==1)
						echo '<p>Pseudo invalide </p>';

			?>
			<label for="email">Email</label><input required type="text" placeholder="Email:ab@cd.com"class="form-control" name="email" id="email"
			<?php if(isset($_GET['result']))
					if($_GET['email']!=1)
						echo 'value="'.$_GET['email'].'"';
			?>
			></input>
			<?php if(isset($_GET['result']))
					if($_GET['email']==1)
						echo '<p>Email invalide</p>';

			?>
			<label for="mot_de_passe1">Mot de passe</label><input required type="password" placeholder="Mot de passe"class="form-control" name="mot_de_passe1" id="mot_de_passe1"></input>
			<?php if(isset($_GET['result']))
					if($_GET['mot_de_passe']==1)
						echo '<p>Mots de passe differents</p> ';

			?>
			<label for="mot_de_passe2">Mot de passe</label><input required type="password" placeholder="Mot de passe" class="form-control"  name="mot_de_passe2" id="mot_de_passe2"></input>
			<?php if(isset($_GET['result']))
					if($_GET['mot_de_passe']==1)
						echo '<p>Mots de passe differents</p> ';

			?>
			<label for="telephone">Telephone</label><input required type="text" placeholder="Telephone:31857941"class="form-control" name="telephone" id="telephone"
			<?php if(isset($_GET['result']))
					if($_GET['telephone']!=1)
						echo 'value="'.$_GET['telephone'].'"';
			?>
			></input>
			<?php if(isset($_GET['result']))
					if($_GET['telephone']==1)
						echo '<p>Telephone invalide </p>';
			?>
			<input type="submit" value="Inscrire"></input>
			<?php if(isset($_GET['message']))
					echo "<p>".$_GET['message']."</p>";
			?>
		</form>
</section>
<?php
if(isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['pseudo']) AND isset($_POST['email']) 
	AND isset($_POST['mot_de_passe1']) AND isset($_POST['mot_de_passe2']) AND isset($_POST['telephone']))
	{
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$pseudo = $_POST['pseudo'];
		$email = $_POST['email'];
		$mot_de_passe1 = $_POST['mot_de_passe1'];
		$mot_de_passe2 = $_POST['mot_de_passe2'];
		$telephone = $_POST['telephone'];

		$verifierTelephone = "#[2-4]{1}[1-469]{1}[1-9]{6}#";
		$verifierEmail= "#[a-z1-9._-]+@[a-z1-9._-]{2,}\.[a-z]{2,4}#";
		$vefierNom = "#([a-zA-Z]+(- )?[a-zA-Z]){2, 81}#";
		$vefierPrenom = "#([a-zA-Z ]{2, 81}#";
		$verifierPseudo = "#[a-zA-Z]\w#";

		if(preg_match("#^([2-4])([0-4]|[6-9])[0-9]{6}$#", $telephone)) { $telephone=$telephone;} else {$telephone=1;}

		if(preg_match("#[a-z1-9._-]+@[a-z1-9._-]{2,}\.[a-z]{2,4}#", $email)) { $email=$email;} else {$email=1;}
		if($mot_de_passe1==$mot_de_passe2){$mot_de_passe=25;} else { $mot_de_passe=1;}
		if(preg_match("#^([a-zA-Z\- ])+$#", $nom)) { $nom=$nom;} else {$nom=1;}
		if(preg_match("#^([a-zA-Z\- ])+$#", $prenom)) { $prenom=$prenom;} else {$prenom=1;}
		if(preg_match("#^\w+$#", $pseudo)) {$pseudo=$pseudo;} else {$pseudo=1;}
		
		if($pseudo==1 OR $nom==1 OR $prenom==1 OR $email==1 OR $mot_de_passe==1 OR $telephone==1){
		header("location: index.php?result&nom=".$nom."&prenom=".$prenom."&pseudo=".$pseudo."&telephone=".$telephone."&mot_de_passe=".$mot_de_passe."&email=".$email);
		}
		else
		{
			$valeur =ajouter_utilisateur($nom, $prenom, $pseudo, $email, $mot_de_passe, $telephone);
			modifier_type_utilisateur($pseudo, "ETUDIANT");
			if($valeur==1){
				$_SESSION['pseudo']=$pseudo;
				header('location:index.php?home');
			}
			else{
				$message = afficher_erreur($valeur);
				header("location: index.php?result&nom=".$nom."&prenom=".$prenom."&pseudo=".$pseudo."&telephone=".$telephone."&mot_de_passe=".$mot_de_passe."&email=".$email."&message=".$message);
			}
		}
	}
	


?>