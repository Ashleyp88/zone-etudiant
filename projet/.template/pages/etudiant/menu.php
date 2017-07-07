<div class="container" id="menu">
<nav class="navbar navbar-default">
	<ul class="nav navbar-nav">
		<li <?php if(isset($_GET['home']))echo 'class="active"';?>> <a href="index.php?page=acceuil" >Accueil</a> </li>
		<li <?php if(isset($_GET['document']))echo 'class="active"';?>> <a href="index.php?page=document">Document</a> </li>
		<li <?php if(isset($_GET['horaire']))echo 'class="active"';?>><a href="index.php?page=forum">Forum</a> </li>
		<li <?php if(isset($_GET['portail']))echo 'class="active"';?>> <a href="index.php?page=portail">Portail</a> </li>
		<li <?php if(isset($_GET['partage']))echo 'class="active"';?>> <a href="index.php?page=partage">Partage</a> </li>
		<li <?php if(isset($_GET['quiz']))echo 'class="active"';?>> <a href="index.php?page=quiz">Quiz</a> </li>			
	</ul>
	<form class="navbar-form pull-right">
		<input type="text" style="width:150px" class="input-small"placeholder="Recherche">
		<button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-search"></span> Chercher</button>
		<button type="submit" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-th-list"></span> 	</button>
	</form>
</nav>
</div>
