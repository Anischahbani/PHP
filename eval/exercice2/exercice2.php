<?php
function conversion($montant, $devise_de_sortie)
{
    
    $resultat = 0;
    
    // Contrôle du type des paramètres
    settype($montant, "float");
    settype($devise_de_sortie, "string");

    // Mise en place de la condition pour la conversion vers la devise de sortie
    if($devise_de_sortie == 'USD')
    {   
        // 1 EUR = 1,24580 USD
        $resultat = $montant * 1.2458;
        echo $montant . '€ ===>' . $resultat . ' $<br>';
    }
    elseif($devise_de_sortie == 'EUR')
    {
        // 1 USD = 0,802697 EUR
        $resultat = $montant * 0.8026;
        echo $montant . '$ ===>' . $resultat . ' €<br>';
    }
    return $resultat;
}

conversion(100, 'USD');
conversion(100, 'EUR');



?>