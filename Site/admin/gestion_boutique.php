<?php 

require_once('../inc/init.php');
if ( !estConnecteEtAdmin() )
{
    header('location:../connexion.php'); // si pas admin, ouste ! va voir la page connexion si j'y suis
    exit();
}

$contenu .='<ul class="nav nav-tabs">
                <li><a href="?action=affichage">Affichage des produits</a></li>
                <li><a href="?action=ajout">Aojuter un produit</a></li>
            </ul>';

if ((isset($_GET['action']) && $_GET['action']=='affichage') || !isset($_GET['action'])){

        //affichage des produits
        $resul = executeRequete("SELECT * FROM produit");
        $contenu .="<h3>Affichage des produits</h3>";
        $contenu .="<p>Nombre de produits : ".$resul->rowCount();
        $contenu .='<table class="table-striped">
                <tr>';
for( $i=0; $i<$resul->columnCount() ; $i++ )
{
    $colonne = $resul->getColumnMeta($i);
    $contenu .= '<th>'.ucfirst($colonne['name']).'</th>';    
}
$contenu .= '<th colspan="2">Actions</th>';
$contenu .="</tr>";

while ( $ligne = $resul->fetch(PDO::FETCH_ASSOC) )
{
    $contenu .='<tr>';

    foreach($ligne as $indice => $information)
    {
        $contenu .='<td class="text-center">'.$information.'</td>';
    }
    $contenu .='<td><a href="?action=modifier&id_produit='.$ligne['id_produit'].$ligne['titre'].' ?\'))">Modifier</a></td>';
    $contenu .='<td><a href="?action=suppression&id_produit='.$ligne['id_produit'].'"onclick="return(confirm(\'Etes vous certain de vouloir supprimer ce membre : '.$ligne['titre'].' ?\'))">Supprimer</a></td>'; 
    $contenu .='</tr>';
}
$contenu .= "</table>";

}
require_once('../inc/haut.php');
echo $contenu;

/*
Affichage d'un formulaire : -vide si je fais "ajout"
                            -pré-rempli si je fais "modifier" sur un produit
*/

if (isset($_GET['action']) && ($_GET['action']=='ajout' || $_GET['action']=='modifier')):
    if( !empty($_GET['id_produit'])){
        $resul = executeRequete("SELECT * FROM produit WHERE id_produit=: id_produit", array('id_produit' =>$_GET['id_produit']));
        $produit_actuel=$resul->fetch(PDO::FETCH_ASSOC);
    }
?>

<h3>Formulaire d'ajout ou de modification d'un produit </h3>
<from method="post" actoin="" enctype="multipart/form-data">
    <input type="hidden" id="id_produit" name="id_produit" value="<?= $produit_actuel['id_produit'] ?? 0 ?>">

    <label for="reference">Reference</label>
    <input type="text" name="reference" id="reference" value="<?$produit_actuel['reference'] ?? ''?>">
    <br>
    <label for="categorie">categorie</label>
    <input type="text" name="categorie" id="categorie" value="<?$produit_actuel['categorie'] ?? ''?>">
    <br>
    <label for="titre">Titre</label>
    <input type="text" name="titre" id="titre" value="<?$produit_actuel['titre'] ?? ''?>">
    <br>
    <label for="description">Description</label>
    <input type="text" name="description" id="description" value="<?$produit_actuel['description'] ?? ''?>">
    <br>
    <label for="couleur">Couleur</label>
    <input type="text" name="couleur" id="couleur" value="<?$produit_actuel['couleur'] ?? ''?>">
    <br>
    <label for="taille">Taille</label>
    <select name="taille">  
        <option <?=(isset($produit_actuel['taille']) && $produit_actuel['taille']=='S') ? 'selected' : '' ?>value="S">S</option>
        <option <?=(isset($produit_actuel['taille']) && $produit_actuel['taille']=='M') ? 'selected' : '' ?>value="M">S</option>
        <option <?=(isset($produit_actuel['taille']) && $produit_actuel['taille']=='L') ? 'selected' : '' ?>value="L">S</option>
        <option <?=(isset($produit_actuel['taille']) && $produit_actuel['taille']=='XL') ? 'selected' : '' ?>value="XL">S</option>
    </select>
    <!-- publie : m, f , mixte-->
    <label for="photo">Photo</label>
    <input type="file" id="photo" name="photo">

    <!--prix , stock-->
    <input type="submit" value="Valider" class="btn btn-primary">
</form>


<?php
endif;    
require_once('../inc/bas.php');

