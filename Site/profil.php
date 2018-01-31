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


//Exercice : Afficher mes commande et leurs détails



$resul = executeRequete("SELECT * FROM commande c, details_commande d, produit p
                         WHERE c.id_commande=d.id_commande
                         AND d.id_produit = p.id_produit 
                         AND c.id_membre = :id_membre",array('id_membre' => $_SESSION['membre']['id_membre']));
                         
if ( $resul->rowCount() > 0 ){

    $contenu .='<table class="table table-bordered">';
    $commande_courante=0; // variable mémoire
    $nb_commandes=0;

    while ( $commande = $resul->fetch(PDO::FETCH_ASSOC))
    {
        if ( $commande['id_commande'] != $commande_courante )
        {
            // entete de commande 1 seule fois par commandes
            $nb_commandes++;
            $contenu .= '<tr>
                        <td colspan="2"><h3>Commande '.$commande['id_commande'].' passée le '.$commande['date_enregistrement'].'<h3><h5>Etat de la commande : '.$commande['etat'].'</h5></td><td colspan="2" class="text-center"><h3>'.$commande['montant'].' €</h3></td></tr>
                        <tr class="CDTR">
                            <th>Quantité</th>
                            <th>Article/Taille</th>
                            <th>Prix Unitaire</th>
                            <th>Total</th>
                        </tr>';
        }

        // ligne d'article
        $contenu .='<tr><td>'.$commande['quantite'].' ex</td><td>'.$commande['titre'].' ( Taille '.$commande['taille'].')</td><td>'.$commande['prix'].' €/pièce</td>
        <td>'.$commande['prix'] * $commande['quantite'].' €</td></tr>';

        //mise à jour de ma variable mémoire
        $commande_courante = $commande['id_commande'];
    }

    $contenu .='</table>';
    $contenu .='<h4>'.$nb_commandes.' commande(s)</h4>';
 }
else{
    $contenu .='<h4>Aucune commande pour le moment</h4>';
}

require_once('inc/haut.php');
echo $contenu ;
require_once('inc/bas.php');


?>