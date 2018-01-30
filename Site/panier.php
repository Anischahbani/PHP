<?php 

require_once('inc/init.php');

//traitements
if (isset($_POST['ajout_panier'])){

    $resul= executeRequete("SELECT * FROM produit WHERE id_produit=:id_produit " , array('id_produit' => $_POST['id_produit']));

    if($resul->rowCount() > 0){
        
        $produit=$resul->fetch(PDO::FETCH_ASSOC);
        //Fonction d'ajout au panier
        ajouterproduitdanspanier($produit['id_produit'],$_POST['quantite'],$_produit['prix']);

        // retour à la fiche produit avec la prise en compte de la mise au panier 
        header('location:fiche_produit.php?statut_produit=ajoute&id_produit='.$_POST['id_produit']);
    }
    else{
        header('location:fiche_produit.php?id_produit='.$_POST['id_produit']);
    }
}


//affichage







require_once('inc/haut.php');

echo $contenu;

require_once('inc/bas.php');