<div class="container">
	<div class="row">
	
		<?php 
		$pub = selectioner_dernieres_publications(4);
		$i=0;
		while($ligne = mysqli_fetch_assoc($pub)){
		?>
		<div class="col-sm-3 grille">
			
			<?php
			echo '<img src="assets/images/pic'.$i.'.jpg">';
			echo "<h4>".$ligne['titre']."</h4>";
			echo "<p>".$ligne['contenu']."</p>";
			?>
			<a href="#"><p class="lire">	Lisez plus <span class="glyphicon glyphicon-chevron-right"> </span></p></a>
		</div>
		<?php
			$i++;}
		?>
	</div>
	<div class="row fil_actualite">
		<div class="col-sm-6  grille">

			<h1 class="titre">Horaire</h1>
			
				<table class="table-bordered" id="horaire">
					<thead>
						<th> </th>
						<th>  Lundi </th>
						<th> Mardi </th>
						<th> Mercredi </th>
						<th> Jeudi </th>
						<th> Vendredi </th>
						<th> Samedi </th>
					</thead>
					<tr>
						<td> 12-2h</td>
						<td>Con. Log</td>
						<td> Con. Log TP</td>
						<td>Linux TP</td>
						<td>Math II</td>
						<td>Prog Java</td>
						<td>BD MySQL</td>
					</tr>
					<tr>
						<td> 2h-4h</td>
						<td>Con. Log</td>
						<td> Con. Log TP</td>
						<td>Linux TP</td>
						<td>Math II</td>
						<td>Prog Java</td>
						<td>BD MySQL</td>
					</tr><tr>
						<td> 4-6h</td>
						<td>Con. Log</td>
						<td> Con. Log TP</td>
						<td>Linux TP</td>
						<td>Math II</td>
						<td>Prog Java</td>
						<td>BD MySQL</td>
					</tr>
				</table>
			
			<h1 class="titre">Dates des Examens</h1>
			
				<table class="table-bordered" id="horaire">
					<thead>
						
						<th>  Examen </th>
						<th> Date Debut </th>
						<th> Date fin </th>
					</thead>
					<tr>
						<td> Intra Session I</td>
						<td>15 Janvier 2017</td>
						<td> 26 Janvier 2017</td>
					</tr>
					<tr>
						<td> Final Session I</td>
						<td>14 Avril 2017</td>
						<td> 22 Avril 2017</td>
					</tr>
					<tr>
						<td> Intra Session II</td>
						<td>19 Juin 2017</td>
						<td> 30 Juin 2017</td>
					</tr>
					<tr>
						<td> Final Session II</td>
						<td>10 Auout 2017</td>
						<td>1 Septembre 2017</td>
					</tr>
				
				</table>
			

			<h1 class="titre">Activite sur le forum</h1>
			<h1 class="lead">Derniers sujets discute</h1>
			<p> Lorem ipsum lorem lula tura milone sata mlanius voler Lorem ipsum lorem lula ?</p>
			<p> Lorem ipsum lorem lula tura milone sata mlanius voler Lorem ipsum lorem lula ?</p>
			
			<h1 class="lead">Sujet recommande</h1>
			<p> Lorem ipsum lorem lula tura milone sata mlanius voler Lorem ipsum lorem lula ?</p>
			<p> Lorem ipsum lorem lula tura milone sata mlanius voler Lorem ipsum lorem lula ?</p>
			
			<h1 class="lead">Conversations les plus animes</h1>
			<p> Lorem ipsum lorem lula tura milone sata mlanius voler Lorem ipsum lorem lula ?</p>
			<p> Lorem ipsum lorem lula tura milone sata mlanius voler Lorem ipsum lorem lula ?</p>
			
			<h1 class="lead">Sujets lies a l'informatique</h1>
			<p> Lorem ipsum lorem lula tura milone sata mlanius voler Lorem ipsum lorem lula ?</p>
			<p> Lorem ipsum lorem lula tura milone sata mlanius voler Lorem ipsum lorem lula ?</p>
			
			

		</div>
		
		<div class="col-sm-6   grille" id="fil_document">
			<h1 class="titre"> Nouveaux Livres</h1>
			<a href="#"> <img src="assets/images/l8.png"></a>
			<a href="#"> <img src="assets/images/l11.png"></a>			
			<a href="#"> <img src="assets/images/l5.png"></a>

			<h1 class="titre"> Nouvelles Formations</h1>
			<a href="#"> <video controls src="assets/videos/1.mp4"> PHP et MySQL</video></a> 
			<div>
		
			Auteur: Bertholin Ambroise <br/>
			Nom:	PHP et MySQL<br/>
			Duree:	7h 30 mn<br/>
			5 chapitre<br/>
			70 videos<br/>
			<a href="#">Visonner la formation</a><br/>
			<a href="#">Telecharger la formation</a>
					
	
			</div>
			
			<a href="#"> <video controls src="assets/videos/4.mp4"></video></a>	
			<div>
		
			Auteur: Kendy Philibert <br/>
			Nom:	Formation Linux<br/>
			Duree:	5h<br/>
			4 chapitre<br/>
			30 videos<br/>
			<a href="#">Visonner la formation</a><br/>
			<a href="#">Telecharger la formation</a>
	
			</div>
					
			<a href="#"> <video controls src="assets/videos/2.mp4"> </video></a>
			<div>
		
			Auteur: Tabitha Bellune<br/>
			Nom:	Formation Ubuntu<br/>
			Duree:	4h 25mn<br/>
			4 chapitre<br/>
			40 videos<br/>
			<a href="#">Visonner la formation</a><br/>
			<a href="#">Telecharger la formation</a>
	
			</div>
			

			
					
		</div>

		
	</div>
	
</div>
