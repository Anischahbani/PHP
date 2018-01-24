<?php
require_once('inc/init.php');

if( !estConnecte()){
    header('location:connexion.php');
    exit();

}

$contenu = '<h2>Bonjour ' .ucfirst($_SESSION['membre']['pseudo']).'</h2>';

if (estConnecteEtAdmin()){
    $contenu .='<p>vous êtes connecté en tant qu\'administrateur</p>';
}

$contenu .='<div><h3>Vos informations de profil </h3><br>
                <p><strong>Email : </strong>'.$_SESSION['membre']['email'].'</p>
                <p><strong> Nom , Prénom : </strong>'.$_SESSION['membre']['nom'].'  ' .$_SESSION['membre']['prenom'].'</p>
                <p><strong>Adresse : </strong>' .$_SESSION['membre']['adresse'].'</p>
                <p><strong>Code postal : </strong>'.$_SESSION['membre']['code_postal'].'</p>
                <p><strong>Ville : </strong>'.$_SESSION['membre']['ville'].'</p></div>';

require_once('inc/haut.php');
echo $contenu ;
require_once('inc/bas.php');


?>