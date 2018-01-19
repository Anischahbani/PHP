<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Document </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>page2</h1>
    <pre>
    <?php
    if ($_GET && !empty($_GET['article']))
    {
        echo 'article:  ' .$_GET['article'] .'<br>';
    }
   /*
   $_GET est une superglobale qui récupère les informations provenant de l'url et créé un tableau associatif

   ex : ?article=jeans&couleur=bleu
   $_GET['article']vaut jeans
   $_GET['couleur']vaut bleu

   /!\ on ne passe de données sensible via $_GET (pas de password, ... )
    
   
   ex : fiche_produit.php?id_produit=657
    */
    ?>

    </pre>
</body>
</html>