<?php 

require_once('inc/init.php');
require_once('inc/haut.php');
$aside='';


// 1 - controler l'existence du produit demandé 
if ( isset($_GET['id_produit']))
{

    $resul = executeRequete("SELECT * FROM produit WHERE id_produit=:id_produit",array('id_produit' => $_GET['id_produit']));
    if ( $resul->rowCount() == 0)
    {
        header('location:index.php');
        exit();
    }
/// si j'arrive ici c'est que j'ai un produit en bdd
    // 2 - Affichage et mise en forme de la fiche produit
    $produit=$resul->fetch(PDO::FETCH_ASSOC);
   // echo "<pre>";
  // var_dump($produit);
   // echo "</pre>";

    $contenu .='<div class="row">
                    <div class="col-sm-12">
                        <h1 class="page-header">'.strtoupper($produit['titre']).'</h1>
                    </div>
                </div>';
    $contenu .='<div class="col-md-8">
                    <img class="img-responsive" src="'.$produit['photo'].'" alt="" title="">
                </div>';
    $contenu .= '<div class="col-md-4">
                    <h3>Description</h3>
                    <p>'.$produit['description'].'</p>
                    <h3>Détails</h3>
                    <ul>
                        <li> Catégorie : '.$produit['categorie'].'</li>
                        <li>Couleur : '.$produit['couleur'].'</li>
                        <li>Taille : '.$produit['taille'].'</li>
                    </ul>
                    <p class="lead">Prix : '.$produit['prix'].' €</p>
                </div>';

// Gérer l'affichage de l'ajout au panier

if ($produit['stock'] > 0){
    $contenu .='<div class="col-md-4">
                <form method="post" action="panier.php">
                    <input type="hidden" name="id_produit" value="'.$produit['id_produit'].'">
                    <select name="quantite" class="form-control">';
                    //Pour la quantité on fixe un maximum à 5 à concurrence du stock disponible 
                    for ($i=1 ; $i<=$produit['stock'] && $i <=5; $i++){
                        $contenu .='<option>' .$i. '</option>';
                    }
    $contenu .=  '</select><br>
                <input type="submit" name="ajout_panier" value="Ajouter au panier" class="form-control btn btn-primary">
                </form>
                </div>';
}
else{
    $contenu .='<div class="col-md-4">
                <p>Produit indisponible</p>
                </div>';
}
// lien de retour a la boutique ( en préselectionnant la categorie du produit consulté)
$contenu .='<div class="col-md-4">
            <p>
            <a href="index.php?categorie=' .$produit['categorie'].'">Produits de même catégorie</a>
            </p>
            </div>';

//Construction de la varibale $aside
//Exercice : alimenter aside
//1. Ecrire la requete pour selectionner les produits de même catégorie differents du produit consulté et limité à 2 produits
//2.exploiter le resultat pour stocker dans la varibale aside le contenu html qui contiendra au moins la photo en vignette et le titre de l'article , et un lien pour aller sur sa fiche produit .
 $resul = executeRequete("SELECT id_produit,photo,titre FROM produit WHERE categorie=:categorie AND id_produit !=:id_produit ORDER BY RAND() LIMIT 0,2" ,array('categorie' => $produit['categorie'],
                                                                                                                                                'id_produit' => $produit['id_produit']));
while ($suggestion = $resul->fetch(PDO::FETCH_ASSOC)){
        $aside .='<div class="col-sm-3">
                    <div class="thumbnail">
                    <a href="?id_produit='.$suggestion['id_produit'].'">
                    <img class="suggimg" src="'.$suggestion['photo'].'"></a>
                    <div class="caption">
                        <h4 class="text-center">'.$suggestion['titre'].'</h4>
                    </div>
                    </div>
                    </div>';    
}
}
else
{
    header('location:index.php');
    exit();
}
//Affichage de la confirmation de l'ajout de l'article au panier

$popup ='';

if(isset($_GET['statut_produit']) && $_GET['statut_produit']=='ajout'){

    $popup ='<div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                         <div class="modal-header">
                            <h4 class="modal-title">Le produit a bien été ajouté au panier </h4>
                        </div>
                        <div class="modal-body">
                            <p><a href="index.php">Continuer ses achats </a></p>
                        </div>
                    </div>
                </div>
            </div>';
}

echo ($popup);
?>
<div class="row">
    <?= $contenu; ?>
</div>
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">Suggestion de produits</h3>
    </div>
    
    <?= $aside?>
</div>



<?php
require_once('inc/bas.php');
?>
<!-- eventuel html -->
<script>
    $(function(){
    $('#myModal').modal("show");
});
</script>