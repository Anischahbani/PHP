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
    -le + pour dire que les caractères sont acceptés de 0 à x fois . 
    */
    
    
    
    
    
    //si tout va bien
    //je controle que le pseudo n'existe pas déja dans la table
    //sinon j'invite l'internaute à changer de pseudo

    //si tout va bien
    // j'insère le nouveau membre dans la table membre 
    //je mets $inscription à true  
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
            <input type="text" name="nom" id="nom" required size="15" class="form-control" value="<?=$_POST['nom']?? ''?>">
        </div>
        <div class="form-group">
            <label for="nom">Email</label>
            <input type="text" name="email" id="email" required size="25" class="form-control"  value="<?=$_POST['email']?? ''?>">
        </div>
        <div class="form-group">
            <label for="civilite">Civilité</label>
            <input type="radio" name="civilite" value="f" <?= (isset($_POST['civilite']) && $_POST['civilite'] == 'f') ? 'checked' : '' ?>/>  Femme
			<input type="radio" name="civilite" value="m" <?= (isset($_POST['civilite']) && $_POST['civilite'] == 'm') ? 'checked' : '' ?>/>  Homme<br/>
        </div>
        <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" name="ville" id="ville" required size="15" class="form-control" value="<?=$_POST['ville']?? ''?>">
        </div>
        <div class="form-group">
            <label for="code_postal">Code Postal</label>
            <input type="text" name="code_postal" id="code_postal" required size="5" class="form-control" value="<?=$_POST['code_postal']?? ''?>">
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <textarea type="text" name="adresse" id="adresse" class="form-control" value="<?=$_POST['adresse']?? ''?>"></textarea>
        </div>

        <div class="form-group">
            <button type="submit" name ="inscription" class ='btn btn-success btn-block' style="margin-top: 25px;">S'inscrire</button>
        </div>
    </form>
</div>
<?php 
endif;

require_once('inc/bas.php');