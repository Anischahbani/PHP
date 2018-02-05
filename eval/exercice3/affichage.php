<?php
// Connexion à la bdd
$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// On sélectionne 
$contenu = $pdo->query("SELECT * FROM movies");
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="Moi">

    <title>Affichage des films</title>

    <!--Bootstrapcdn-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">

          <a class="navbar-brand" href="formulaire_film.php">Ajouter un film</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="affichage.php">Affichage des films</a></li>
          </ul>
        </div>
    </nav>

    <div class="container">

      <div class="starter-template text-center">
        <br><br><br><h1>Affichage des films</h1>
      </div>

      <div class="row">
        <div class="col-sm-12">
            <table border="1" style="width: 80%; margin:0 auto; border-collapse: collapse; text-align: center;">
                <tr>
                <?php
                    $requete = $pdo->query("SELECT title, director, year_of_prod, id_movie FROM movies");
                    $nb_col = $requete->columnCount();
                   

                    for($i = 0; $i < $nb_col; $i++)
                    {
                        $colonne = $requete->getColumnMeta($i);
                        
                        if ($colonne['name'] != 'id_movie')
                        { 
                            echo '<th style="padding: 10px; text-align: center;">' . $colonne['name'] . '</th>';
                        }
                    }
                    echo '<th style="padding: 10px; text-align: center;">Plus d\'info</th>';
                    echo '</tr>';
                    while($ligne = $requete->fetch(PDO::FETCH_ASSOC))
                    {
                        echo '<tr>';
                            foreach($ligne AS $indice => $info)
                            {
                                if($indice == 'title')
                                {
                                    echo '<td style="padding: 10px; text-align :center;">' . $info . '</td>';
                                }
                                elseif($indice == 'director')
                                {
                                    echo '<td style="padding: 10px; text-align :center;">' . $info . '</td>';
                                }
                                elseif($indice == 'year_of_prod')
                                {
                                    echo '<td style="padding: 10px; text-align :center;">' . $info . '</td>';
                                }
                            }
                            echo '<td style="padding: 10px; text-align: center;"><a href="fiche_film.php?id_movie=' . $ligne['id_movie'] . '"><button type="button" class="btn      btn-primary">Voir la fiche</button></a></td>';
                            echo '</tr>';
                        }
                ?>
                </table>
            </div>
        <div>
    </div>


  
    </body>
</html>