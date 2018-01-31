<?php 

require_once('../inc/init.php');

if ( !estConnecteEtAdmin() )
{
    header('location:../profil.php'); // si pas admin, ouste ! va voir la page connexion si j'y suis
    exit();
}



if(isset($_POST['action']) && $_POST['action'] == 'validation_modification' && is_numeric($_POST['id_commande']))
{   
    $id_commande = $_POST['id_commande'];
    $etat = $_POST['etat'];
    $pdo->exec("UPDATE commande SET etat = '$etat' WHERE id_commande = '$id_commande' ");  
}


// La ligne suivante commence les affichages dans la page
require_once('../inc/haut.php');
?>

        

        <div class="container">

            <div class="starter-template">
                <h1><span class="glyphicon glyphicon-file" style='color: lightblue'></span> Gestion commandes</h1>
                <?php // echo $message; // messages dédiés à l'utilisateur ?>
                
            </div>
            <?php
            $commandes = $pdo->query("SELECT c.id_commande, c.montant, c.date_enregistrement, p.titre, p.photo, d.quantite, m.id_membre, m.pseudo, m.adresse, m.ville, m.code_postal, c.etat
            FROM commande c, produit p, details_commande d, membre m
            WHERE m.id_membre = c.id_membre
            AND c.id_commande = d.id_commande
            AND d.id_produit = p.id_produit
            ORDER BY date_enregistrement DESC");
            $nb_col = $commandes->columnCount();
            

            echo '<table border="1" style="margin: 0 auto; border-collapse: collapse; text-align: center; width: 100%"><thead>';
            for($i = 0; $i < $nb_col; $i++)
            {
                $colonne = $commandes->getColumnMeta($i);
                if($colonne['name'] == 'id_commande')
                {
                    echo '<th class="text-center" style="padding: 10px;">N° de commande</th>';
                }
                elseif($colonne['name'] == 'id_membre')
                {
                    echo '<th class="text-center" style="padding: 10px;">N° de membre</th>';
                }
                else
                {
                echo '<th class="text-center" style="padding: 10px;">' . $colonne['name'] . '</th>';
                }
            }
            echo '<th class="text-center" style="padding: 10px;">Action</th>';
            echo '</thead><tbody>';
            while($commande = $commandes->fetch(PDO::FETCH_ASSOC))
            {   
                $colonne = $commandes->getColumnMeta($i);
                echo '<tr>';
                foreach($commande AS $indice => $val)
                if($indice == 'photo')
                {
                    echo '<td><img src="'.RACINE_SITE.'photo/' . $val . '" alt="Photo de l\'article" width="50"></td>';
                }
                else
                {
                    echo '<td class="text-center" style="padding: 10px;">' . $val . '</td>';
                }
                echo '<td><form action="" method="POST">
                            <input type="hidden" name="id_commande" value="'. $commande['id_commande'] . '">
                            <select name="etat" id="etat">
                            <option value="en cours de traitement">En cours de traitement</option>
                            <option value="envoye">Envoyé</option>
                            <option value="livre">Livré</option>
                            </select>
                            <button type="submit" class="btn btn-success" style="margin-top: 5px;">Valider</button>
                        </form></td>';
                echo '</tr>';
            }
            echo '</tbody></table><br>';
            ?>
        </div><!-- /.container -->
<?php
require_once('../inc/bas.php');





?>