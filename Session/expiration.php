<?php

session_start();

echo 'temps actuel : '.time() . '<br>';
print_r($_SESSION); // print_r permet d'afficher le contenu d'une varibale de type array

if (isset($_SESSION['temps'])){ // si l'entrée temps existe dans $_SESSION
    if(time()> ($_SESSION['limite']+$_SESSION['temps'])){ 
        session_destroy(); // si c'est le cas , la page n'a pas été rafraichie dans les 10 secondes , on déteruit la session
        echo 'expiration de la session';
    }
    else{
        $_SESSION['temps']=time();
        echo 'connexion mis à jour : 10 secondes de plus !';
    }
}
else{

    echo 'connexion';
    $_SESSION['limite']=10 ; //je fixe le temps d'inactivité (seconde)
    $_SESSION['temps']=time();
}

/*
Les informations d'une session sont enregistrées coté serveur , cela créé dans le meme temps un COOKIE qui identifie la session :
PHPSESSID
sur le pc et navigateur du client.
Si l'internaute supprime ses cookies , il casse le lien entre l'id de session et les infos stockés sur le serveur

En général sur les sites qui vous proposent une connection , il y a une session qui vous "garde" connecté à partir du moment où vous êtes passés une fois par la porte d'entrée .(vous vous êtes identifiés)

Avantage : vos infos de session sont conservées d'un page à l'autre du site (ex:on conserve son panier)

 */

