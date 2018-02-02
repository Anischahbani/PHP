<?php
require_once('admin/init.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Tp</title>
</head>
<body>
    
    <h1>Programme de la semaine</h1>
    <?php
               
    $programmes = $base->query("SELECT * FROM programmes");
	while ( $programme = $programmes->fetch(PDO::FETCH_ASSOC)){
                    echo'<div class="col-sm-3 hauteur">
                    <h4>'.$programme['nom_du_programme'].'</h4>
                    <div class="thumbnail">
                    <img src="'.$programme['image'].'"  class="img-responsive">
                        <div class="caption">
                            <h5 class"pull-right">Nom du programme : '.$programme['nom_du_programme'].'</h5>
                            <h5>Date de diffusion : '.$programme['date_diffusion'].'</h5>
                            <h5>Heure de début : '.$programme['heure_debut'].'</h5>
                            <h5>Heure de fin: '.$programme['heure_fin'].'</h5>
                            <h5>Public : '.$programme['public'].'</h5>
                            <h5>genre : '.$programme['genre'].'</h5>
                            <h5>Description: '.$programme['description'].'</h5>
                        </div>
                    </div>
               </div>';
                   
                }
                ?>
	
</body>
</html>










 




 



