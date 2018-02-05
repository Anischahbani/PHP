<?php

$info = array();

$info['Prénom']   ='Anis';
$info['Nom']='CHAHBANI';
$info['Adresse']='44 quai de la marne';
$info['Code Postal'] ='75019';
$info['Ville'] = 'Paris';
$info['Email'] = 'anischahbani@gmail.com';
$info['Téléphone'] = '07.87.27.84.74';
$info['Date de naissnce'] = '16/11/1989';


echo '<ul>';
foreach ($info AS $indice => $valeur){
    echo '<br><li>'.$indice.' : '.$valeur.'</li>';
}
echo'</ul>';

?>

