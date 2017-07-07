<?php
include 'fonctions.php';
$pub = selectioner_dernieres_publications(5);

while($ligne = mysqli_fetch_assoc($pub))
{
	echo "<h1>".$ligne['titre']."</h1>";
	echo "<p> ".$ligne['contenu']."</p>";
}
?>
