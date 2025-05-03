<footer >
    <link rel="stylesheet" href="<?= base_url('/css/style.css') ?>">
 
    <h3>
        <div class="stat">STATISTIQUES DES FORUMS</div>
    </h3>
    <h4>
        <div class="p2">
            <div class="message"><?= $this->articleCount ?> <br>Total des Articles</div>
            <div class="message"><?= $this->messageCount ?> <br>Total des Messages</div>
        </div>
    </h4>

    <h3>
        <div class="stat">STATISTIQUES DES MEMBRES</div>
    </h3>
    <h4>
        <div class="p2">
            <div class="message"><?= $this->userCount ?> <br>Total des membres</div>
            <div class="message1"><?= $this->latestMember ?><br>Membre le plus récent</div>
        </div>
    </h4>

    <a class="charte1" href="<?= base_url('/pdf/Charte.pdf') ?>" target="_blank">charte du site</a>
</footer>
