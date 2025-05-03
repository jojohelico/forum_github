<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="<?php echo base_url('/css/style.css'); ?>">
</head>

<body>
    <center>
        <h1>Connexion</h1>
    </center>
    <a class="accue" href="<?php echo base_url('/home'); ?>">
        <img class="acc" src="<?php echo base_url('/images/accueil.jpg'); ?>" alt="Accueil" />
        <div class="accu"> Accueil </div>
    </a>&nbsp;&nbsp;&nbsp;
    
    <center>
        <form method="POST" action="<?php echo base_url('/user/login'); ?>">            
            <fieldset class="connexionf">
                <legend> Vos identifiants </legend><br>
                <input type="email" name="email" id="email" placeholder="Mail" required /><br /><br>
                <input type="password" name="motdepasse" id="motdepasse" placeholder="Mot de passe" required /><br />
                <input class="envoyer" type="submit" name="btnenvoyer" value="Envoyer" /><br>
            </fieldset>
        </form>
        <?php if (isset($_SESSION['error'])): ?>
            <p class="attention"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>
    </center>
</body>
</html>
