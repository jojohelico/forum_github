<?php
 include("layout/header.php"); 
 ?>

<div class="main">
    <?php foreach ($categories as $cat): ?>
        <div class="man">
            <a class="p1a"><?= htmlspecialchars($cat['nomCat']) ?></a>
        </div>

        <?php foreach ($cat['rubriques'] as $rub): ?>
            <h4>
                <table width="100%">
                    <tr class="ligneUtil">
                        <td class="p1a">
                            <a class="p1" href="<?= base_url('/rubrique/show?rub=' . $rub['idRub']) ?>">
                                <?= htmlspecialchars($rub['nomRub']) ?><br>
                                <span class="p1b"><?= htmlspecialchars($rub['descRub']) ?></span>
                            </a>
                        </td>

                        <td style="text-align:center; width:100px">
                            <?= $rub['nbArticles'] + $rub['nbReponses'] ?>
                            <br><?= ($rub['nbArticles'] + $rub['nbReponses']) > 1 ? 'messages' : 'message' ?>
                        </td>

                        <td width="60">
                            <?php if (!empty($rub['latest']['prenom'])):?>
                                <span class="avatar">
                                    <?= strtoupper(substr($rub['latest']['prenom'], 0, 1)) ?>
                                </span>
                            <?php else: ?>
                                &nbsp;
                            <?php endif; ?>
                        </td>

                        <td width="150">
                            <?php if (!empty($rub['latest']['prenom'])): ?>
                                <a class="p1" href="<?= base_url('/reponse/show?id=' . $rub['latest']['idArt']) ?>">
                                    <?= htmlspecialchars($rub['latest']['titre']) ?>
                                </a><br>
                                Par 
                                <span class="<?= $rub['latest']['typeMemb'] == 0 ? 'administrateur' : ($rub['latest']['typeMemb'] == 1 ? 'moderateur' : 'utilisateur') ?>">
                                    <?= htmlspecialchars($rub['latest']['prenom']) ?>
                                </span><br>
                                il y a <?= calculate_time_span($rub['latest']['date']) ?>
                            <?php else: ?>
                                &nbsp;
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </h4>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
<?php include("layout/footer.php"); ?>