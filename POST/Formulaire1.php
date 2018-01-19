<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Document </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Formulaire</h1>
    <pre>
    <?php
    //var_dump($_POST);
    if($_POST && empty($_POST['email'])){
        echo "veuillez saisir un email valide <hr>";
    }
        //implode, explode , extract 

        $parametres = implode('#', $_POST);
        var_dump($parametres);
        
        $date ='19/01/2018';
        $date_tableau = explode('/', $date);
        var_dump($date_tableau);


        $csv= "champ1;champ2;champ3;champ avec des espaces ; champ4";
        $tab= explode (';',$csv);
        var_dump($tab);

        var_dump($_POST);
        extract($_POST); 
        echo $prenom ;
       
      
    ?>
    </pre>
    <form method="post" action="">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" placeholder="ici votre prénom" value="<?= $_POST['prenom'] ?? '';?>"> <!-- isset($_POST['prenom']) ? $_POST['prenom'] : '' ;-->
        <br>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="ici votre email" value="<?= $_POST['email'] ?? '' ; ?>">
        <br>
        <label for="message">Message</label>
        <textarea name="message" id="message" cols="40" rows="5" placeholder="ici votre message" ><?= $_POST['message'] ?? '';?></textarea>
        <br>
        <input type="submit" value ="Envoyer le message" >
</body>
</html>