<?php 
$db = Database::getConnexion();
$config = require '../config/config.php';
$baseURL = $config['base_url'];
?>

<link rel="stylesheet" href="<?php echo $baseURL; ?>/css/style.css">
<footer>


    <h3>
        <div class="stat"> STATISTIQUES DES FORUMS </div>
        
    </h3>
    <h4>
        <div class="p2">
            <div class="message">Total des Articles</div>
            <div class="message">Total des Messages</div>
            
            <?php //Nombre d'article
            $resultatNbArt = $cnn->prepare('SELECT COUNT(*) FROM article');
            $resultatNbArt->execute();
            $ResArt = $resultatNbArt->fetchColumn();
            echo '<div class="message">' . $ResArt . '<br> Total des Articles</div>';

            ?>
            

            <?php
            // Nombre de messages des articles
            $resultatNbArt = $cnn->prepare('SELECT COUNT(*) as NbArt FROM article');
            $resultatNbArt->execute();
            $ResArt = $resultatNbArt->fetch(PDO::FETCH_ASSOC); // Utilisation de fetch(PDO::FETCH_ASSOC) pour obtenir un tableau associatif

            $resultatNbRep = $cnn->prepare('SELECT COUNT(*) as NbRep FROM reponse'); // Requête pour compter les réponses
            $resultatNbRep->execute();
            $Resrep = $resultatNbRep->fetch(PDO::FETCH_ASSOC); // Utilisation de fetch(PDO::FETCH_ASSOC) pour obtenir un tableau associatif

            $NbMessage = $ResArt['NbArt'] + $Resrep['NbRep']; // Addition des nombres d'articles et de réponses
            echo '<div class="message">' . $NbMessage . '<br> Total des messages</div>'; // Affichage du nombre total de messages
            ?>

        <div class="message">Total des Messages</div>
        </div>

    </h4>


    <h3>
        <div class="stat"> STATISTIQUES DES MEMBRES </div>
        <p>kzefnzk</p> 
    </h3>
    <h4>
        <div class="p2">

            <?php 
            // Nombre de membre
            $nb = $baseURL . '/user/nbMembres';
            echo '<div class="message">' . $nb . '<br> Total des membres</div>';
            ?>

            <!-- <?php //Membre le plus récent
            $dateIns = $cnn->prepare('SELECT nomMemb FROM membre ORDER BY dateIns DESC');
            $dateIns->execute();
            $date = $dateIns->fetchColumn();
            echo '<div class="message1">' . $date . '<br>Membre le plus récent</div>';
            ?> -->
        </div>
    </h4>
    <a class="charte1" href="<?php include $baseURL; ?>/pdf/Charte.pdf" target="_new">charte du site</a>

</footer>
</body>

</html>