<<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css"/>
    <title>PDO</title>
</head>
<body>
    

<?php

// PDO : Php Data Object

echo "<h2>01 - PDO: Connexion</h2>";

$pdo = new PDO('mysql:host=localhost;dbname=entreprise',
               'root',
               '',
               array(
                   PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                   PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
               ));

echo "<h2>02 - PDO: Insert,Update,Delete</h2>";

/*
$pdo->exec("INSERT INTO employes VALUES (NULL,'test','test','M','commercial','2018-01-22',500)");
echo 'dernier id ajouté :' . $pdo->lastInsertId();
$dernier_id = $pdo->lastInsertId();

$pdo->exec("UPDATE employes SET salaire=1400 WHERE id_employes=".$dernier_id);
*/
$resul = $pdo -> exec("DELETE FROM employes WHERE id_employes=994"); 
echo $resul;// vaut 1 au premier affichage , puis 0 si je rafraichis

//$pdo ->exec execute une requete directe (insert , update , delete)
//si je stocke l'execution dans une varible (ex:resul) , il contiendra le nombre de ligne affectées par la requete 

echo "<h2>03 - PDO: Select</h2>";

$resul = $pdo ->query("SELECT * FROM employes WHERE prenom='daniel'");
echo'<pre>';
var_dump($resul);
var_dump(get_class_methods($resul));
echo'</pre>';

$employe_daniel = $resul ->fetch(PDO::FETCH_ASSOC);

// var_dump($employe_daniel);
echo 'Bonjour, je suis '.$employe_daniel['prenom'].' '.$employe_daniel['nom'].' du service ' .$employe_daniel['service'].'.<br>';

/*
$pdo est un  objet(1) issu de la classe prédéfinie PDO 
Quand on execute une requete de selection via la methode query() sur l'objet PDO, on obtient un autre objet(2) issu de la classe PDOStatement qui a ses propriétés et methodes.
si on execute une requete de type insert ,update , delete avec query() au lieu de exec() , on obtient un booléen.
*/


echo "<hr>";

// select avec plusieurs résultats 

$resul = $pdo ->query("SELECT * FROM employes WHERE service='commercial'");

echo 'Nombre de commerciaux : '.$resul->rowCount(). '<br>';

while ($contenu=$resul->fetch(PDO::FETCH_ASSOC))
{

    echo $contenu['prenom'].' '.$contenu['nom']. '('.$contenu['sexe']. ') <br>' ;
}

//select tableau multidimensionnel

$resul = $pdo ->query("SELECT * FROM employes WHERE service='commercial'");

$donnees = $resul ->fetchAll (PDO::FETCH_ASSOC);
echo '<pre>';
var_dump($donnees);
echo '</pre>';

echo '<br>';

foreach($donnees as $indice1 =>$contenu1){
    echo"<div class='madiv'>";
    foreach ($contenu1 as $indice2 => $contenue2) {
        echo "$indice2 : $contenue2 <br>";
    }
    echo"</div>";
}
//Exercice : Afficher la liste des bases de données dans une liste html

//Solution 
/*$liste= $pdo ->query("SHOW DATABASES");
$databases=$liste ->fetchALL (PDO::FETCH_ASSOC);
echo '<pre>';
var_dump($databases);
echo '</pre>';

foreach($databases as $indice3 =>$contenu3){
 echo "<li> ";
    foreach($contenu3 as $indice4 =>$contenu4){
        echo "$contenu4 <br>";
    }
 echo"</li>";
}
*/

//Correction
$resul= $pdo ->query("SHOW DATABASES");
echo "<ul>";
while($base = $resul->fetch(PDO::FETCH_ASSOC)){

  $database = $base['Database'];
  echo "<li>" .$database."<ul>";
    $pdo->exec("USE `".$database."`" );
    $resul2= $pdo -> query("SHOW TABLES");
    while($table = $resul2->fetch(PDO::FETCH_ASSOC)){

        //ex: Tables_in_bibliotheque
        echo "<li>".$table['Tables_in_'.$database]."</li>";
    }
echo "</ul></li>";
}
echo"</ul>";

//Parcours de table

$pdo->exec ('USE bibliotheque');
$nomtable ="livre";
$resul=$pdo->query("SELECT * FROM ".$nomtable);

echo "<table><tr>";

//Générer les entêtes de colonnes
$nbcolonnes=$resul->columnCount(); // columnCount() renvoie le nbre de colonnes
for($i=0; $i< $nbcolonnes; $i++){
    $infoscolonne=$resul->getColumnMeta($i);// getColumnMeta(index) envoie les informations d'une colonne comme son type son nom etv sa longueur , dans notre exemple c'est l'index "name"qui nous intéresse.
    echo'<th>'.$infoscolonne['name'].'</th>';
}
echo"</tr>";

//prcours des enregistrements
while ($ligne=$resul->fetch(PDO::FETCH_ASSOC)){
    echo"<tr>";
        foreach($ligne as $information){
            echo "<td>$information</td>";
        }
    echo"</tr>";
}

echo "</table>";
echo"<br>";

echo "<h2>PDO : prepare , bindParam, bindValue , execute</h2>";
$pdo->exec('USE entreprise');
$nom = 'sennard';

$resul = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");
$resul->bindParam(':nom' ,$nom,PDO::PARAM_STR);//bindParam recoit exclusivement une variable
$resul->execute();
$donnees=$resul->fetch(PDO::FETCH_ASSOC);
echo implode(' ',$donnees);

echo "<br>";
$nom = 'thoyer';
$resul = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");
$resul->bindValue(':nom' ,$nom,PDO::PARAM_STR);//bindValue recoit une variable ou une chaine de caractère 
$resul->execute();
$donnees=$resul->fetch(PDO::FETCH_ASSOC);
echo implode(' ',$donnees);

?>
</body>
</html>