<?php

/*
exercice : 
créer un formulaire pour demander le pseudo à l'internaute .
quand il valide son pseudo , on garde l'information en session
quand il revient sur la page , on lui indique "votre pseudo est <pseudo>" et on n'affiche plus le formulaire 
Ne pas enregistrer d'information si le pseudo est vide.
*/
?>

<?php 
    session_start();
    if ($_POST && !empty($_POST['pseudo'])){
        $_SESSION['pseudo']=$_POST['pseudo'];
      
    }
    if (isset($_SESSION['pseudo'])) {
    echo "votre pseudo est  " .$_SESSION['pseudo']. '<hr>';
    }
    else{
    ?>
<form method="post" action="">
        <label for="pseudo">Pseudo:</label>
        <input type="text" name="pseudo" id="pseudo">
        <input type="submit" value ="Envoyer" >
    <?php
    }