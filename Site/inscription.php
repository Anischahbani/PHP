<?php
require_once('inc/init.php');

$inscription = false;  //inscription pas faite , je m'en sers pour afficher le formulaire

if($_POST){
    //je poste mon formulaire d'inscription 
    // controles sur les champs
    $champs_vides=0;
    foreach ($_POST as $indice =>$valeur){
        if (empty($valeur)){
            $champs_vides++;
        }

    }

    if ($champs_vides > 0 ){
        $contenu .='<div class="alert alert-danger">Il y a ' .$champs_vides.' information(s) manquante(s)</div>';
    }

    //verifier qu'une chaine contient des caractères autorisés
    $verif_caractere    = preg_match('#^[a-zA-Z0-9._-]+$#',$_POST['pseudo']);
    $verif_codepostal   = preg_match('#^[0-9]{5}$#',$_POST['code_postal']);
    //expression régulière 
    /*
    
    -je délimine l'expression par le symbole # debut et fin
    -^signifie "commznce par tout ce qui suit"
    -$ signifie "finit par tout ce qui précède"
    -[] pour delimnier les intervalles (ici de a à z , de A à Z , de 0 à 9 , et on ajoute ".", "_"ou "-")
    -le + pour dire que la chaine peut faire de 1 à n caractères.

        + équivalent de {1,}
        ? équivalent de {0,1}
        * équivalent de {0,}
        {5} précidement
        {3,15} de 3 à 15 caractères 

    */
    if (!$verif_caractere){
        $contenu .= '<div class="alert alert-danger">Le pseudo doit contenir 3 à 15 caractères (lettre de a à Z , chiffres de 0 à 9, _.-)</div>';
    }
    
    if (!$verif_codepostal){
        $contenu .= '<div class="alert alert-danger">Le code n\'est pas correct</div>';
    }
    
    if ($_POST['civilite'] !='m' && $_POST['civilite'] !='f'){
        $contenu .= '<div class="alert alert-danger">De quel genre êtes-vous</div>';
    }

    //astuce de controle d'email avec filter_var , fonction qui vérifie la chaine de caractère par rapport à un format 
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $contenu .= '<div class="alert alert-danger">Adresse mail invalide</div>';
    }
    
    
    //si tout va bien
    //je controle que le pseudo n'existe pas déja dans la table
    //sinon j'invite l'internaute à changer de pseudo
    $membre = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo" , array('pseudo' => $_POST['pseudo']));
    if ($membre->rowCount()>0){
        $contenu .= '<div class="alert alert-danger">Pseudo indisponible , merci d\'en choisir un autre</div>';
    }

    //si tout va bien
    // j'insère le nouveau membre dans la table membre 
    //je mets $inscription à true  
    if (empty($contenu)){
        executeRequete("INSERT INTO membre VALUES(NULL,:pseudo,:mdp,:nom,:prenom,:email,:civilite,:ville,:code_postal,:adresse,0)" , array('pseudo' =>$_POST['pseudo'],
                                                                                                                                     'mdp' =>MD5($_POST['mdp']),
                                                                                                                                     'nom' =>$_POST['nom'],    
                                                                                                                                     'prenom' =>$_POST['prenom'],
                                                                                                                                     'email' =>$_POST['email'],    
                                                                                                                                     'civilite' =>$_POST['civilite'],    
                                                                                                                                     'ville' =>$_POST['ville'],    
                                                                                                                                     'code_postal' =>$_POST['code_postal'],   
                                                                                                                                     'adresse' =>$_POST['adresse']    ));
        $contenu .='<div class="alert alert-success">Vous êtes inscrit à notre site . <a href="connexion.php">Cliquer ici pour vous connecter</a></div>';
        $inscription = true ;
    }
}

require_once('inc/haut.php');
echo $contenu;
if (!$inscription):
?>

<!--formulaire d'inscription-->
<!-- champs : pseudo,mdp,prenom,nom,email,civilite,ville,code_postal,adresse-->
<div class="row">
<div class="col-xs-6 col-xs-push-3 well">
    <form method="POST" action ="">
        <div class="form-group">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" class="form-control" value="<?= $_POST['pseudo']?? '' ?>">
        </div>
        <div class="form-group">
            <label for="mdp">Mot de passe</label>
            <input type="text" name="mdp" id="mdp" class="form-control" value="<?=$_POST['mdp']?? ''?>">
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="<?= $_POST['prenom']?? ''?>">
        </div>
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom"  size="15" class="form-control" value="<?=$_POST['nom']?? ''?>">
        </div>
        <div class="form-group">
            <label for="nom">Email</label>
            <input type="text" name="email" id="email"  size="25" class="form-control"  value="<?=$_POST['email']?? ''?>">
        </div>
        <div class="form-group">
            <label for="civilite">Civilité</label>
            <input type="radio" name="civilite" value="f" <?= (isset($_POST['civilite']) && $_POST['civilite'] == 'f') ? 'checked' : '' ?>/>  Femme
			<input type="radio" name="civilite" value="m" <?= (isset($_POST['civilite']) && $_POST['civilite'] == 'm' || (!isset($_POST['civilite']))) ? 'checked' : '' ?>/>  Homme<br/>
        </div>
        <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" name="ville" id="ville"  size="15" class="form-control" value="<?=$_POST['ville']?? ''?>">
        </div>
        <div class="form-group">
            <label for="code_postal">Code Postal</label>
            <input type="text" name="code_postal" id="code_postal"  size="5" class="form-control" value="<?=$_POST['code_postal']?? ''?>">
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <textarea type="text" name="adresse" id="adresse" class="form-control" cols="35" rows="4" ><?=$_POST['adresse']?? ''?></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class ='btn btn-success btn-block' style="margin-top: 25px;">S'inscrire</button>
        </div>
    </form>
</div>
<?php 
endif;

require_once('inc/bas.php');