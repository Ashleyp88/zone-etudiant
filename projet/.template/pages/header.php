<div class="row">
	<div id="logo" class="col-sm-2">
		<img src="assets/images/logo.png">
	</div>
	
	<?php
		if(isset($_SESSION['pseudo']))
			include 'perso.php';
		else
			include 'pages/connexion.php';
	?>
	
</div>