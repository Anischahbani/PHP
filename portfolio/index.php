<?php

require_once('admin/init.php');

if($_POST){
	if( !empty($_POST['email']) && !empty($_POST['objet']) && !empty($_POST['msg'])){
		$email 	= htmlspecialchars($_POST['email']);
		$objet	= htmlspecialchars($_POST['objet'],ENT_QUOTES);
		$msg 	= htmlspecialchars($_POST['msg'],ENT_QUOTES);

		$req 	= $base->prepare("INSERT INTO messages VALUES (NULL,:email,:objet,:msg,NOW())");
		$req->execute(array('email' =>$email,
							'objet'=>$objet,
							'msg'=>$msg));
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<!-- métadonnées -->
		<meta charset="UTF-8" />
		<title>Mon titre</title>
		<meta name="description" content="ma description" />
		<meta name="keywords" content="mots clés, clefs" />
		<!-- fichiers css -->
		<link rel="stylesheet" href="css/normalize.css" />
		<link rel="stylesheet" href="css/style.css" /><link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> 
		
	</head>
	<body>
		<!-- Présentation / Réalisations / Parcours / Contact  -->
		<header>
			<div class="conteneur ligne">
				<div class="bloc40">
					<h1><a href="index.html">Anis</a></h1>
				</div>
				<div class="bloc60 ligne">
					<nav class="ligne">
						<a href="#link1">Présentation</a>
						<a href="#link2">Réalisation</a>
						<a href="#link3">Parcours</a>
						<a href="#link4">Contact</a>
					</nav>
				</div>
			</div>
		</header>
		<section id="section1">
			<div id="link1"></div>
			<div class="conteneur ligne">
				<div class="bloc70">
					<h2>Qui suis-je ?</h2>
					<img class="imageronde" src="images/avatar.png" alt="Mon portrait" /><p>
						Vous êtes à la recherche
						
						d'un développeur pour gerer vos projets web ?<br />
						Je peux renforcer votre équipe, autant sur la partie graphique que sur le developpement.<br /><br />
						Seriez vous prêt à me donner ma chance ?
					</p>
				</div>
				<div class="bloc30">
					<h2>Compétences</h2>
					<ul>
						<?php 
							$competences = $base->query("SELECT * FROM competences");

							while ( $competence = $competences->fetch(PDO::FETCH_ASSOC)){
								echo '<li>
									<h3>'.$competence['titre'].'</h3>
									<div class="jauge_fond">
									<div class="jauge_couleur" style="background:'.$competence['couleur'].' ; width:'.$competence['pourcentage'].'% ;">
								
									</div>
									</div>
									</li>';
							
							}
							
						?>
					</ul>
				</div>
				<div class="bloc100 ligne">
					<h2>Mes langages favoris</h2>
					<?php
						$langages = $base->query("SELECT * FROM langages");
						while ( $langage = $langages->fetch(PDO::FETCH_ASSOC)){
							echo'<div class="bloc25">
							<img src="'.$langage['image'].'" alt="'.$langage['alternatif'].'" />
						</div>';
						}
					?>
					
				</div>
			</div>
		</section>
		<section id="section2" class="couleur1">
			<div id="link2"></div>
			<div class="conteneur ligne">
				<h2>Réalisations</h2>
				<?php
				$realisations = $base->query("SELECT * FROM realisations");
				while ( $realisation = $realisations->fetch(PDO::FETCH_ASSOC)){
					
					echo'<div class="bloc33">
					<figure>
						<img src="'.$realisation['image'].'" alt="'.$realisation['alternatif'].'" />
						<figcaption>
							<h3>
								<a href="">'.$realisation['legende'].'</a>
							</h3>
						</figcaption>
					</figure>
				</div>';
				}
				
				
				?>
			</div>
			</div>
		</section>
		<section id="section3" class="couleur2">
			<div id="link3"></div>
			<div class="conteneur ligne">
				<div class="bloc66">
					<h2>Expériences</h2>
					<?php
					$experiences = $base->query("SELECT * FROM experiences ORDER BY annee_debut DESC");
					while ( $experience = $experiences->fetch(PDO::FETCH_ASSOC)){

							//si annee_deb est DateTime en sql
							//$date_formatee = new DateTime($experience['annee_debut']);
							//$annee_deb = $date_formatee->format('d/m/Y');


						echo'<table>
						<tr>
							<td class="year" rowspan="2">
								'.$experience['annee_fin'].'
								<p>'.$experience['annee_debut'].'</p>
							</td>
							<td class="job">'.$experience['job'].'</td>
						</tr>
						<tr>
							<td class="job_desc">'.$experience['job_desc'].'</td>
						</tr>
					</table>';
					}
					
					?>
					
				</div>
				<div class="bloc33 couleur4">
					<h2>Formation</h2>
					<?php
					$formations = $base->query("SELECT * FROM formations ORDER BY annee DESC");
					while ( $formation = $formations->fetch(PDO::FETCH_ASSOC)){
						
						
						echo'<table>
						<tr>
							<td class="year" rowspan="2">
								'.$formation['annee'].'
							</td>
							<td class="job">'.$formation['universite'].'</td>
						</tr>
						<tr>
							<td class="job_desc">'.$formation['universite_desc'].'</td>
						</tr>
					</table>';
					}
					?>
					
					
					
				</div>
			</div>
		</section class="couleur1">
		<section id="section4">
			<div id="link4"></div>
			<div class="conteneur ligne">
				<div class="bloc50">
					<h2>Coordonnées</h2>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2626.0722849056215!2d2.3316375505194795!3d48.83775987918385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671c7785c4fd3%3A0xa335415b3909439d!2s82+Avenue+Denfert-Rochereau%2C+75014+Paris!5e0!3m2!1sfr!2sfr!4v1513094217478" allowfullscreen></iframe>
				</div>
				<div class="bloc50">
					<h2>Contactez-moi</h2>
<form method="post" action="#" >
	<label for="email">Email</label>
	<input type="email" id="email" name="email" required placeholder="Votre email ici..."/>
	
	<label for="objet">Objet</label>
	<input type="text" id="objet" name="objet" required placeholder="Votre objet ici..." />
	
	<label for="msg">Message</label>
	<textarea required name="msg" id="msg" placeholder="Votre message ici..."></textarea>
	
	 <input type="submit" name="submit" value="Envoyer" />
</form>
					
				</div>
			</div>
		</section>
		<footer>
			<div class="conteneur">
				Bas de page
			</div>
		</footer>
		
		
	</body>
</html>







