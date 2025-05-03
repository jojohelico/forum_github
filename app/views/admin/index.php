<?php include("../app/views/layout/header.php"); ?>

<body>
    <div class="main">
        <?php if (isset($_SESSION['idMemb']) && $_SESSION['type'] == 0): ?>
            <br><br>
            <div class="man"><a class="p1a">Utilisateurs</a></div>
            <div class="tableDiv">
                <table class="tableUtil">
                    <?php foreach ($membres as $ligne): ?>
                        <tr>
                            <td class="colUtilPnom"><?= $ligne['prenomMemb'] ?></td>
                            <td style="colUtilNom"><?= $ligne['nomMemb'] ?></td>
                            <td class="colUtilMail"><?= $ligne['emailMemb'] ?></td>
                            <td class="colUtilSupp">
                                <div class="flex">
                                    <a href="<?= base_url('/admin/updateType?idMemb=' . $ligne['id']) ?>">
                                        <button class="buttonStatut <?= $ligne['typeMemb'] == 0 ? 'rouge' : ($ligne['typeMemb'] == 1 ? 'bleu' : 'noir') ?>">
                                            <?= $ligne['typeMemb'] == 0 ? 'Administrateur' : ($ligne['typeMemb'] == 1 ? 'Modérateur' : 'Utilisateur') ?>
                                        </button>
                                    </a>
                                    <a href="<?= base_url('/admin/deleteUser?idMemb=' . $ligne['id']) ?>"
                                    onclick="return(confirm('CONFIRMATION DE SUPPRESSION\n\n Etes-vous sûr de vouloir supprimer ce membre?'));">
                                        <button class="buttonStatut gris">Supprimer</button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <br><br>
            <script>
                function AffDiv() {
                    let d1 = document.getElementById("AjoutArticle");
                    d1.style.display = d1.style.display === "none" ? "block" : "none";
                }
            </script>

            <?php foreach ($categories as $Cat): ?>
                <div class="man"><a class="p1a"><?= $Cat['nomCat'] ?></a></div>
                <h4>
                    <table width="100%">
                        <?php foreach ($rubriques as $Rub): ?>
                            <?php if ($Rub['idCat'] == $Cat['idCat']): ?>
                                <tr>
                                    <td class="p1a">
                                        <a class="p1" href="<?= base_url('/rubrique/show?rub=' . $Rub['idRub']) ?>"><?= $Rub['nomRub'] ?></a></td>
                                    <td>
                                        <div class="flex">
                                            <a href="<?= base_url('/rubrique/modifier?Rubrique=' . $Rub['idRub']) ?>"
                                            onclick="return(confirm('CONFIRMATION DE MODIFICATION\n\n Etes-vous sûr de vouloir modifier cette rubrique?'));">
                                                <button class="buttonStatut gris">Modifier</button>
                                            </a>

                                            <a href="<?= base_url('/rubrique/supprimer?Rubrique=' . $Rub['idRub']) ?>"
                                            onclick="return(confirm('CONFIRMATION DE SUPPRESSION\n\n Etes-vous sûr de vouloir supprimer cette rubrique?'));">
                                                <button class="buttonStatut gris">Supprimer</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </table>
                </h4>
                <br>
            <?php endforeach; ?>

            <button class="buttonStatut gris" type="button" id="btnAjouter" onclick="AffDiv()">Ajouter une rubrique</button>

            <div id="AjoutArticle" style="display:none;">
                <center>
                    <form method="post" action="<?= base_url('/adminrub/add') ?>" name="formrub">
                        <fieldset class="connexionf">
                            <legend>Ajouter une rubrique</legend><br>
                            <select name="IdCat">
                                <?php foreach ($categories as $ligne): ?>
                                    <option value="<?= $ligne['idCat'] ?>"><?= $ligne['nomCat'] ?></option>
                                <?php endforeach; ?>
                            </select><br><br>
                            <label for="NomRub">Titre</label><br />
                            <input type="text" name="NomRub" id="NomRub" required /><br><br>
                            <label for="DescRub">Description</label><br />
                            <textarea name="DescRub" id="DescRub" required rows="10" cols="50"></textarea><br />
                            <input class="envoyerRub" type="submit" id="envoyerRub" value="Ajouter" name="ajouter">
                        </fieldset>
                    </form>
                </center>
            </div>

        <?php else: ?>
            <?php header('Location: ' . base_url('/home')); ?>
        <?php endif; ?>
    
    </div>

</body>

<?php include("../app/views/layout/footer.php"); ?>
