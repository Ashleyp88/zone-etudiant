
<div id="perso" class="col-sm-7 col-sm-offset-3">
	<div class="col-sm-8">
	<?php
	$pseudo = $_SESSION['pseudo'];
	echo '<h4> Bienvenue '.chercher_info_utilisateur($pseudo, "prenom").' '.chercher_info_utilisateur($pseudo, "nom").'</h4>';
	?>
		<button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-tags"></span> Notificatiion</button>
		<button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-envelope"></span> Message</button>
		<button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-user"></span> Personalisation</button>
		<a href="index.php?deconnection" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-off"></span> Deconnection</a>
	</div> 
	<div class="col-sm-2 col-sm-offset-1">
		<img src="assets/images/pic7.jpg" class="img-circle">				
	</div>
</div>
