<?php 
function estConnecte(){
    //la présence de l'index membre dans la superglobale $_SESSION indique que le membre est connecté 
 if(isset($_SESSION['membre'])){
     return true;
}
else{
    return false;
}
}
function estConnecteEtAdmin(){
    // s'il est connecté et que son statut vaut 1 c'est qu'il s'agit d'un admin
    if (estConnecte() && $_SESSION['membre']['statut']==1){
        return true ;
    }
    else{
        return false;
    }
}

function executeRequete($sql,$params=array()){
    if (!empty($params))
    {
        foreach($params as $indice =>$param){
            $params[$indice]=htmlspecialchars($param,ENT_QUOTES);       
         }
    }

    global $pdo ;
    $r=$pdo->prepare($sql);
    $r->execute($params);

    if( !empty($r->errorInfo()[2])){
        die('<p>Erreur rencontrée pendant la requête . Message '.$errorInfo()[2].'</p>');
    }
    return $r; //on retourne l'objet issu de la requete à l'endroit ou la fonction a été appelée 
}

//Fonction liées au panier

function creationpanier(){
    //si le panier n'existe pas on le créé vide 
    if (!isset($_SESSION['panier'])){
        $_SESSION['panier'] = array();
        $_SESSION['panier']['id_produit'] = array();
        $_SESSION['panier']['quantite'] = array();
        $_SESSION['panier']['prix'] = array();
    } 
}
function ajouterproduitdanspanier($id_produit,$quantite,$prix){
    creationpanier();

    // Avant d'ajouter, on vérifie si le produit n'est pas déjà présent dans le panier, si c'est le cas, on ne fait que modifier sa quantité
    $position_produit = array_search( $id_produit , $_SESSION['panier']['id_produit']);
    // array_search() permet de vérifier si une valeur se trouve dans un tableau array. Si c'est le cas, on récupère l'indice correspondant.
    if($position_produit === false){
        $_SESSION['panier']['id_produit'][]=$id_produit;
        $_SESSION['panier']['quantite'][]=$quantite;
        $_SESSION['panier']['prix'][]=$prix;

    }
    else{
        $_SESSION['panier']['quantite'][$position_produit] +=$quantite;
    }
}



function nbArticlesPanier(){

    $nb='';
    if(isset($_SESSION['panier']['id_produit'])){
        $nb=array_sum($_SESSION['panier']['quantite']);
        if ($nb !=0){
            $nb ='<span class="badge">' .$nb.'</span>(' .montanttotal(). ' € )';
        }
        else{
            $nb='';
        }
    }
    return $nb;
}
function montanttotal(){
            
            $total=0;
            for($i=0; $i <count($_SESSION['panier']['id_produit']); $i++)
            {
                $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];
            }
            return $total;

}


?>