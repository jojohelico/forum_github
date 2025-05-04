<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>forum bts sio</title>
    <link rel="stylesheet" href="<?php echo base_url('/css/style.css'); ?> ">
</head>

<body>
    <header>
        <h1> <a href="https://lyc-mathias-chalon-sur-saone.eclat-bfc.fr/"><img class="img" src="<?php echo base_url('/images/logo.png'); ?> " alt="Image flottante" /></a>
            <div class="titre1">𝒻𝑜𝓇𝓊𝓂 𝐵𝒯𝒮 𝒮𝒾𝑜</div>
            <?php
            if (isset($_SESSION['idMemb'])) {
                echo '<a href="' . base_url('/user/logout') . '">
                <input class="deconnexion" type="button" value="Déconnexion (' . $_SESSION['prenom'] . ' ' . $_SESSION['nom'] . ')"</a></h1>';
            } else {
                echo '<a href="' . base_url('/user/login') . '">
                <input class="connexion" type="button" value="Utilisateur existant? Connexion"0/></a>
                <a href="' . base_url('/user/signIn') . '">
                <input class="inscription" type="button" name="connexion" value="s\'inscrire" /></a></h1>';
            }
            ?>

            <?php
            echo '<a class="accue" href="' . base_url('/home') . '"';
            ?>
                <img class="acc" src="<?php echo base_url('/images/accueil.jpg'); ?> " alt="Image flottante" />
                <div class="accu"> Accueil
            </a>&nbsp;&nbsp;&nbsp;
            <?php
            if (isset($_SESSION['type'])) {
                if ($_SESSION['type'] == 0)
                    echo '<a class="accu" href="' . base_url('/admin/index') . '">Administrateur</a>';
            }
            ?>

            </div>

    </header>