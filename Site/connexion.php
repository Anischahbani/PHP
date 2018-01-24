<?php

require_once('inc/init.php');

//traitement 
if(isset($_GET['action']) && $_GET['action'] == 'deconnexion' ){
    session_destroy();
}
if (estConnecte()){
    header('location:profil.php'); // Renvoie un entete au client pour demander la page profil 
    exit(); //puis quitter le script 

}
if ($_POST) //if (!empty($_POST))
{
$motdepassecrypte= md5 ($_POST['mdp']); // je crypte le mot de passe saisi pour le comparer à la version cryptée du mot de passe enregistré en base 

//requete de selection pour vérifier que le membre existe et qu'il a saisi correctement ses identifiants
$sql= "SELECT * FROM membre WHERE pseudo = :pseudo AND mdp= :mdp";
$resul = executeRequete( $sql, array('pseudo' => $_POST['pseudo'],
                                        'mdp' => $motdepassecrypte
                                    ));



if( $resul->rowCount() !=0){
    // si j'ai un résultat égal à 1 c'est que j'ai trouvé un membre qui a ce login et ce mot de passe

$membre = $resul-> fetch(PDO::FETCH_ASSOC);
$_SESSION['membre']= $membre;
header('location:profil.php');
exit();
}
else{
    $contenu .='<div class="bg-danger">Erreur sur les identifiants</div>';
}
}

require_once('inc/haut.php');
echo $contenu ;


?>
<!--Exercice créer le formulaire de connnexion-->
<div class="row">
<div class="col-xs-6 col-xs-push-3 well">
    <form method="POST" action ="">
        <div class="form-group">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" class="form-control" value="">
        </div>
        <div class="form-group">
            <label for="mdp">Mot de passe</label>
            <input type="text" name="mdp" id="mdp" class="form-control" value="">
        </div>
        <div class="form-group">
            <button type="submit" name ="connexion" class ='btn btn-success btn-block' style="margin-top: 25px;">Se connecter</button>
        </div>
    </form>
</div>
<?php 
require_once('inc/bas.php');

?>