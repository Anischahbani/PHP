<?php 

require_once('../inc/init.php');

if ( !estConnecteEtAdmin() )
{
    header('location:../connexion.php'); // si pas admin, ouste ! va voir la page connexion si j'y suis
    exit();
}

//suppression
if(isset($_GET['action']) && $_GET['action']=='suppression' &&isset($_GET['id_produit'])){

    $resul = executeRequete("SELECT photo FROM produit WHERE id_produit=:id_produit",array('id_produit' =>$_GET['id_produit']));
    $photo_a_supprimer = $resul->fetch(PDO::FETCH_ASSOC);
    $chemin_photo=$_SERVER['DOCUMENT_ROOT'] .$photo_a_supprimer['photo'];

    if (!empty($photo_a_supprimer['photo']) && file_exists($chemin_photo)){
        unlink($chemin_photo);
    }
    executeRequete("DELETE  FROM produit WHERE id_produit=:id_produit",array('id_produit' =>$_GET['id_produit']));
    $contenu .='<div class="alert alert-success">Le produit a été supprimé</div>';
    $_GET['action']='affichage';
}



// Onglets affichage ajout/modif
$contenu .='<ul class="nav nav-tabs">
                <li><a href="?action=affichage">Affichage des produits</a></li>
                <li><a href="?action=ajout">Ajouter un produit</a></li>
            </ul>';

//  Enregistrement du produit en BDD
if ( $_POST ){

    $photo_bdd='';
if ( isset($_POST['photo_actuelle']))
{
    $photo_bdd=$_POST['photo_actuelle'];
} 
//Ajouter des controles sur le format la taille et l'extension de l'image
if ( !empty($_FILES['photo']['name']))
{
    $nom_photo = $_POST['reference'].'-'.$_FILES['photo']['name'];
    $photo_bdd = RACINE_SITE.'photo/'.$nom_photo;
    $photo_dossier= $_SERVER['DOCUMENT_ROOT'].$photo_bdd;

    copy($_FILES['photo']['tmp_name'], $photo_dossier);
}

// on enregistre le produit en base 

executeRequete("REPLACE INTO produit VALUES (:id_produit, :reference,:categorie,:titre,:description,:couleur,:taille,:public,:photo,:prix,:stock)", array(
                                                                                                                                                'id_produit' =>$_POST['id_produit'],
                                                                                                                                                'reference' =>$_POST['reference'],
                                                                                                                                                'categorie' =>$_POST['categorie'],
                                                                                                                                                'titre' =>$_POST['titre'],
                                                                                                                                                'description' =>$_POST['description'],
                                                                                                                                                'couleur' =>$_POST['couleur'],
                                                                                                                                                'taille' =>$_POST['taille'],
                                                                                                                                                'public' =>$_POST['public'],
                                                                                                                                                'photo' => $photo_bdd,
                                                                                                                                                'prix' =>$_POST['prix'],
                                                                                                                                                'stock' =>$_POST['stock']


));

$contenu .='<div class="alert alert-success">Le produit a été enregistré</div>';
$_GET['action'] = 'affichage';
}


if ((isset($_GET['action']) && $_GET['action']=='affichage') || !isset($_GET['action']))
{
    // Affichage des produits
    $resul = executeRequete("SELECT * FROM produit");
// entêtes//
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
// les données
while ( $ligne = $resul->fetch(PDO::FETCH_ASSOC) )
{
    $contenu .='<tr>';

    foreach($ligne as $indice => $information)
    {
        if(($indice=='photo') && $information !=''){
            $information='<img class="img-thumbnail" src=" '.$information.'" alt="'.$ligne['titre'].'">';
        }
        $contenu .='<td class="text-center">'.$information.'</td>';
    }
    $contenu .='<td><a href="?action=modifier&id_produit='.$ligne['id_produit'].$ligne['titre'].' ?\'))">Modifier</a></td>';
    $contenu .='<td><a href="?action=suppression&id_produit='.$ligne['id_produit'].'"onclick="return(confirm(\'Etes vous certain de vouloir supprimer ce produit : '.$ligne['titre'].' ?\'))">Supprimer</a></td>';
    $contenu .='</tr>';
}
    $contenu .= "</table>";

}
require_once('../inc/haut.php');
echo $contenu;


/* Affichage d'un formulaire : - vide si je faids "ajout */
/*                             - pré-rempli si je fais "modifier" sur un produit
                               - 
*/                            
if ( isset($_GET['action']) && ( $_GET['action']=='ajout' || $_GET['action']=='modifier') )
:
//if ( "j'ai une action définie" && ( elle vaut "ajout" OU elle vaut "modifier") )
    if (!empty($_GET['id_produit']))
    {
        $resul = executeRequete("SELECT * FROM produit WHERE id_produit=:id_produit",array('id_produit'=>$_GET['id_produit']));
        $produit_actuel=$resul->fetch(PDO::FETCH_ASSOC);
    }

?>
<h3> Formulaire d'ajout ou de modification d'un produit</h3>
<div class="col-xs-6 col-xs-push-3 well">
<form method="post" action="" enctype="multipart/form-data">
    <input class="form-control" type="hidden" id="id_produit" class="form-control" name="id_produit" value="<?= $produit_actuel['id_produit'] ?? 0 ?>">
    <div class="form-group">
    <label for="reference">Reference</label>
    <input class="form-control" type="text" name="reference" id="reference" class="form-control" value="<?= $produit_actuel['reference'] ?? '' ?>">
    </div>
    <div class="form-group">
    <label for="categorie">Categorie</label>
    <input class="form-control" type="text" name="categorie" id="categorie" class="form-control" value="<?= $produit_actuel['categorie'] ?? '' ?>">
    </div>
    <div class="form-group">
    <label for="titre">Titre</label>
    <input class="form-control" type="text" name="titre" id="titre" class="form-control" value="<?= $produit_actuel['titre'] ?? '' ?>">
    </div>
    <div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" cols="40" rows="3" class="form-control" value="<?= $produit_actuel['description'] ?? '' ?>"></textarea>
    </div>
    <div class="form-group">
    <label for="couleur">Couleur</label>
    <input class="form-control" type="text" name="couleur" id="couleur" class="form-control" value="<?= $produit_actuel['couleur'] ?? '' ?>">
    </div>
    <div class="form-group">
    <label for="taille">Taille</label>
    <select name="taille">
        <option <?= (isset($produit_actuel['taille']) && $produit_actuel['taille']=='S') ? 'selected' : ''?> value="S">S</option>
        <option <?= (isset($produit_actuel['taille']) && $produit_actuel['taille']=='M') ? 'selected' : ''?> value="M">M</option>
        <option <?= (isset($produit_actuel['taille']) && $produit_actuel['taille']=='L') ? 'selected' : ''?> value="L">L</option>
        <option <?= (isset($produit_actuel['taille']) && $produit_actuel['taille']=='XL') ? 'selected' : ''?> value="XL">XL</option>
    </select>
    </div>
    <!-- public : m,f mixte -->
    <div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" name="photo" id="photo" class="form-control">
    </div>
    <?php 
        if ( isset($produit_actuel['photo']))
        {
            echo '<p>Vous pouvez uploader une nouvelle photo </p>';
            echo '<img class="img-thumbnail" src="'.$produit_actuel['photo'].'" alt="'.$produit_actuel['titre'].'">';
            echo '<input type="hidden" name="photo_actuelle" value="'.$produit_actuel['photo'].'">';
            // cet input permet de remplir $_POST sur un indice "photo_actuelle" la valeur de l'url de la photo stockée en base. Ainsi, si on ne
            // charge pas de nouvelle photo, l'url actuelle sera remise en base
        }

    ?>

<div class="form-group">
<label for="public">Public</label>
<input type="radio" name="public" value="m" <?= (isset($produit_actuel['public']) && $produit_actuel['public']=='m' || !isset($produit_actuel['public'])) ? 'checked' : '' ?>>Homme
<input type="radio" name="public" value="f" <?= (isset($produit_actuel['public']) && $produit_actuel['public']=='f') ? 'checked' : '' ?>>Femme
<input type="radio" name="public" value="mixte" <?= (isset($produit_actuel['public']) && $produit_actuel['public']=='mixte') ? 'checked' : '' ?>>Mixte
</div>
    
    <div class="form-group">
    <label for="prix">Prix</label>
    <input class="form-control" type="text" name="prix" id="prix" class="form-control" value="<?= $produit_actuel['prix'] ?? '' ?>">
    </div>
    <div class="form-group">
    <label for="stock">Stock</label>
    <input class="form-control" type="text" name="stock" id="stock" class="form-control" value="<?= $produit_actuel['stock'] ?? '' ?>">
    </div>

    <div class="form-group">
    <button type="submit" class ='btn btn-success btn-block' style="margin-top: 25px;">Valider</button>
    </div>
</form>
</div>
<?php

endif;




require_once('../inc/bas.php');
