<?php
$config = require '../config/config.php';
$baseURL = $config['base_url'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="<?php echo $baseURL; ?>/css/style.css">
</head>
<body>
    <center>
        <h1>Inscription</h1>
    </center>
    <a class="accue" href="<?php echo $baseURL; ?>/home">
        <img class="acc" src="<?php echo $baseURL; ?>/images/accueil.jpg" alt="Accueil" />
        <div class="accu"> Accueil </div>
    </a>&nbsp;&nbsp;&nbsp;

    <div class="main">    
        <center>
            
            <form method="POST" action="<?php echo $baseURL; ?>/user/signIn">
                <fieldset class="connexionf">
                    <legend> Vos identifiants </legend><br>
                    <input type="text" name="nom" id="nom" placeholder="Nom"/><br /><br>
                    <input type="text" name="prenom" id="prenom" placeholder="Prénom" /><br /><br>
                    <input type="email" name="email" id="email" placeholder="Mail"/><br /><br>
                    <input type="password" name="motdepasse" id="motdepasse" placeholder="Mot de passe"/><br />
                    <input type="submit" name="btnenvoyer" value="Envoyer" onclick="if(!this.form.checkbox.checked)
                    {
                        alert('Vous devez accepter la charte informatique pour vous inscrire');
                        return false;
                    }
                        " ><br>
                </fieldset>
                <?php if (isset($_SESSION['error'])): ?>
                    <p class="attention">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
                <?php endif; ?>
            </form>
        </center>
    </div>
</body>
</html>


<?php include("../app/views/layout/footer.php"); ?>
