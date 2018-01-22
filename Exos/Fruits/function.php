<?php
 // Exercice

 /* 
 sachant que l'on recoit du maraicher les prix suivants :
 -cerises 5,76 € /kg
 -bananes 1,09€ /kg
 -pommes 1,61€ /kg
 -peches 3,23€/ kg

 ecrire la fonction calcul()
 qui renvoie la phrase :
 Les <nom des fruits> coutent <resultat du calcul> € pour <poids> kg 
 requis : utiliser un switch .
 */

/* function calcul($fruit,$poids){
    $resultat=0;
    if ($fruit =='cerises'){
        $resultat= $poids * 5,76 ;
        echo $fruit. 'coutent' .$resultat. '€ pour ' .$poid. 'kg' ;
    }
    elseif ($fruit =='bananes'){
        $resultat= $poids * 1,09 ;
        echo $fruit. 'coutent' .$resultat. '€ pour ' .$poid. 'kg' ;
    }
    elseif ($fruit =='pommes'){
        $resultat= $poids * 1,61 ;
        echo $fruit. 'coutent' .$resultat. '€ pour ' .$poid. 'kg' ;
    }
    elseif ($fruit =='peches'){
        $resultat= $poids * 3,23 ;
        echo $fruit. 'coutent' .$resultat. '€ pour ' .$poid. 'kg' ;
    }
    return $resultat;
}
    */


function calcul($fruit,$poids){
  
    switch ($fruit){
        case"cerises":
        $pak= 5.56;
       
        break;
        case"bananes":
        $pak= 1.09 ;
        break;
        case"pommes":
        $pak= 1.61;
        break;
        case"peches":
        $pak= 3.23;
        break;
        default : echo "fruit inexistant";
    }
     $resultat =$poids*$pak ;
     return "les $fruit coutent $resultat € pour $poids kg<br>";

}
    

   


